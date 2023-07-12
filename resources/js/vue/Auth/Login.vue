<template>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">
                        <i class="mdi mdi-login-variant mdi-24px"></i> ورود به حساب کاربری
                    </h4>

                    <form>
                        <div class="mb-3">
                            <label for="loginUsernameOrEmail" class="form-label">نام کاربری یا ایمیل</label>
                            <input type="text" id="loginUsernameOrEmail" required maxlength="50" class="form-control" placeholder="نام کاربری یا ایمیل خود را وارد کنید ...">
                        </div>

                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">رمز عبور</label>
                            <input type="password" id="loginPassword" class="form-control" required maxlength="30" placeholder="رمز عبور حساب خود را وارد کنید ...">
                        </div>

                        <button class="btn btn-primary w-100" type="submit">
                            <i class="mdi mdi-check-bold"></i> تایید و ورود به حساب
                        </button>
                    </form>

                    <hr>

                    <div>
                        هنوز ثبت نام نکرده اید؟
                        <router-link class="link-offset-3 link-opacity-75-hover" :to="{name: 'auth.register'}">
                            <i class="mdi mdi-account-plus-outline"></i> ثبت نام در وبلاگ
                        </router-link>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        document.getElementById('loginUsernameOrEmail').focus();
    },
};
</script>
