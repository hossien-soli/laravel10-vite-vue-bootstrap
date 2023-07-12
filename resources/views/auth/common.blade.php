@extends('layouts.master')

@section('content')
<div id="vueApp"></div>
@endsection

@section('end_links')
@vite('resources/js/vue/auth.js')
@endsection
