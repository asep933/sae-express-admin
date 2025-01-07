<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
                </a>

                <div class="ml-auto">
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-user-shield"></i> Admin
                    </a>
                </div>
            </div>
        </nav>


        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <h1 class="m-0">@yield('header', 'Tracking Page')</h1>
                </div>
            </div>

            <div class="content">
                <div class="container">
                    @yield('main')
                </div>
            </div>
        </div>

        <footer class="main-footer text-center">
            <div class="container">
                <small>© {{ date('Y') }} Arsithra . All rights reserved.</small>
            </div>
        </footer>
    </div>

    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>

</html>