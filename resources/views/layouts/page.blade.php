<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Дежурства сотрудников') }}</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/page.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>
        <x-footer/>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        @stack('js')
    </body>
</html>
