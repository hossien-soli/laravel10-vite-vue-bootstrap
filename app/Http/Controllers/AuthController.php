<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function login(): View
    {
        $pageTitle = 'ورود به حساب کاربری';
        $hideAuthLinks = true;
        return view('auth.common',compact('pageTitle','hideAuthLinks'));
    }

    public function register(): View
    {
        $pageTitle = 'ثبت نام';
        $hideAuthLinks = true;
        return view('auth.common',compact('pageTitle','hideAuthLinks'));
    }

    public function password(): View
    {
        $pageTitle = 'بازنشانی رمز عبور';
        $hideAuthLinks = true;
        return view('auth.common',compact('pageTitle','hideAuthLinks'));
    }

    public function _registerPOST(Request $request): JsonResponse
    {
        $fullName = $request->input('full_name');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        $validation = Validator::make($request->all(),[
            'full_name' => 'required|string|max:30',
            'email' => 'required|string|max:50|email',
            'username' => 'required|string|min:5|max:20|alpha_dash',
            'password' => 'required|string|min:6|max:30|confirmed',
        ]);

        if ($validation->fails()) {
            $message = $validation->errors()->all()[0];
            return Response::json(commonJsonResponse(false,null,$message));
        }

        $email = strtolower($email);
        $emailFound = DB::table('users')->where('email',$email)->count() >= 1;
        if ($emailFound) {
            $message = Lang::get('messages.email_not_unique');
            return Response::json(commonJsonResponse(false,null,$message));
        }

        $username = strtolower($username);
        $usernameFound = DB::table('users')->where('username',$username)->count() >= 1;
        if ($usernameFound) {
            $message = Lang::get('messages.username_not_unique');
            return Response::json(commonJsonResponse(false,null,$message));
        }

        $rateLimiterKey = 'register' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimiterKey,5)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            if ($seconds > (3600 * 2)) {  // hours
                $hours = round($seconds / 3600);
                $message = Lang::get('messages.rate_limit_hours',['value' => $hours]);
            }
            elseif ($seconds > (60 * 2)) {  // minutes
                $minutes = round($seconds / 60);
                $message = Lang::get('messages.rate_limit_minutes',['value' => $minutes]);
            }
            else {  // seconds
                $message = Lang::get('messages.rate_limit_seconds',['value' => $seconds]);
            }

            return Response::json(commonJsonResponse(false,null,$message));
        }

        $user = User::query()->create([
            'full_name' => $fullName,
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($password),
        ]);

        RateLimiter::hit($rateLimiterKey,3600);

        event(new Registered($user));
        Auth::login($user,true);

        $redirectUrl = URL::route('user.panel');
        return Response::json(commonJsonResponse(true,['redirect_url' => $redirectUrl],null));
    }

    public function _loginPOST(Request $request): JsonResponse
    {
        $usernameOrEmail = $request->input('username_or_email');
        $password = $request->input('password');

        $validation = Validator::make($request->all(),[
            'username_or_email' => 'required|string|max:50',
            'password' => 'required|string|min:6|max:30',
        ]);

        if ($validation->fails()) {
            $message = $validation->errors()->all()[0];
            return Response::json(commonJsonResponse(false,null,$message));
        }

        $usernameOrEmail = strtolower($usernameOrEmail);
        $key = 'username';
        if (filter_var($usernameOrEmail,FILTER_VALIDATE_EMAIL)) { $key = 'email'; }

        $rateLimiterKey = 'login' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimiterKey,15)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            if ($seconds > (3600 * 2)) {  // hours
                $hours = round($seconds / 3600);
                $message = Lang::get('messages.rate_limit_hours',['value' => $hours]);
            }
            elseif ($seconds > (60 * 2)) {  // minutes
                $minutes = round($seconds / 60);
                $message = Lang::get('messages.rate_limit_minutes',['value' => $minutes]);
            }
            else {  // seconds
                $message = Lang::get('messages.rate_limit_seconds',['value' => $seconds]);
            }

            return Response::json(commonJsonResponse(false,null,$message));
        }

        RateLimiter::hit($rateLimiterKey,3600);

        $user = User::query()->where($key,$usernameOrEmail)->first();
        if (!$user) {
            $message = Lang::get('messages.invalid_username_or_password');
            return Response::json(commonJsonResponse(false,null,$message));
        }

        $hashedPassword = $user->password;
        if (!Hash::check($password,$hashedPassword)) {
            $message = Lang::get('messages.invalid_username_or_password');
            return Response::json(commonJsonResponse(false,null,$message));
        }

        Auth::login($user,$request->filled('remember'));
        RateLimiter::clear($rateLimiterKey);

        $redirectUrl = URL::route('user.panel');
        return Response::json(commonJsonResponse(true,['redirect_url' => $redirectUrl],null));
    }
}
