<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"> --}}
    <title>trach.io - Tracheostomy Care App</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <meta name="user-id" content="{{ optional(Auth::user())->id }}">
    <meta name="user-name" content="{{ optional(Auth::user())->name }}">
    <meta name="user-email" content="{{ optional(Auth::user())->email }}">
    <meta name="first-name" content="{{ explode(' ', trim(optional(Auth::user())->name))[0]  }}">
    <meta name="user-plan-name" content="{{ auth()->user()->onTrial() ? 'Trial' : auth()->user()->plan['name'] }}">
    <meta name="tenant-id" content="{{ session('tenant_id') }}">
    <meta name="role-id" content="{{ session('role_id') }}">
    <meta name="timezone" content="{{ session('timezone') }}">
    <meta name="timezone-offset" content="{{ session('timezone_offset') }}">
    <style>

    </style>
</head>

    <body>
        <div id="app">
            <div class="h-full flex">
                <navigationside ></navigationside>
                <div class="flex flex-1 flex-col min-w-0 bg-gray-200 ">
                    <navigationtop></navigationtop>
                    <router-view></router-view>
                </div>
            </div>
        </div>
        @include('includes.footer')
    </body>
</html>

