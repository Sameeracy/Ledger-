<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon/favicon.png') }}">
    <title>{{ config('app.name', 'Ledger+') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="auth-body">
    <!-- Floating Theme Toggle -->
    <button class="icon-button theme-toggle auth-theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
        <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
    </button>

    <main class="auth-page">
        <section class="auth-card">
            <!-- Brand Mark -->
            <a class="auth-brand" href="{{ url('/') }}">
                <span class="brand-icon"><i class="bi bi-wallet2" aria-hidden="true"></i></span>
                <span>
                    <strong>Ledger<span class="text-primary">+</span></strong>
                    <small>Smart Debt & Expense Manager</small>
                </span>
            </a>

            <!-- Auth Visual Header -->
            <div class="auth-visual">
                <img src="{{ asset('assets/images/png/dasher-ui-bootstrap-5.jpg') }}" alt="Ledger+ Dashboard">
            </div>

            {{ $slot }}
        </section>
    </main>
</body>
</html>