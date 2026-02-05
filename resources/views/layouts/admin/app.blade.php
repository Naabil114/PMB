<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name') }}</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo.webp') }}">

    {{-- CSS --}}
    @include('layouts.admin.css')

    @stack('styles')
</head>

<body>
<div id="app">
    <div class="main-wrapper">

        <div class="navbar-bg"></div>

        {{-- Navbar --}}
        @include('layouts.admin.navbar')

        {{-- Sidebar --}}
        @include('layouts.admin.sidebar')

        {{-- Main Content --}}
        <div class="main-content">
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('layouts.admin.footer')

    </div>

    {{-- Logout Modal --}}
    @include('layouts.admin.logout-modal')
</div>

{{-- Scripts --}}
@include('layouts.admin.scripts')
@include('layouts.admin.toast')

@stack('scripts')
</body>
</html>
