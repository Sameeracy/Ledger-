<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo/favicon.jpeg') }}">  
        <title>Ledger+</title>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="bg-light d-flex align-items-center justify-content-center min-vh-100 py-5">
        <div class="w-100" style="max-width: 420px;">
            <!-- Brand Logo Header Above the Card -->
            <div class="text-center mb-4">
                <a href="{{ url('/') }}" class="text-decoration-none display-6 fw-bold text-dark">
                    Ledger<span class="text-primary">+</span>
                </a>
            </div>

            <!-- Auth Form Card -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>