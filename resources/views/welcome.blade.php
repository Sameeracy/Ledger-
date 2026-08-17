<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ledger+ | Smart Debt & Expense Tracking</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light min-vh-100 d-flex flex-column">

    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
                Ledger<span class="text-primary">+</span>
            </a>

            <div class="d-flex align-items-center gap-2">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Hero Section -->
    <main class="flex-grow-1 d-flex align-items-center py-5">
        <div class="container">
            <div class="row align-items-center justify-content-between g-5">
                
                <!-- Left: Product Overview & Actions -->
                <div class="col-lg-6">
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3 fw-semibold">
                        Personal Expense & Debt Manager
                    </span>
                    <h1 class="display-5 fw-bold text-dark mb-3">
                        Track who owes you and what you owe.
                    </h1>
                    <p class="lead text-muted mb-4">
                        <strong>Ledger+</strong> is a dedicated personal finance ledger built to record shared bills, loans, and credit balances in PKR. Get real-time surplus/deficit calculations, instant search filtering, and quick one-click settlement tracking.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                                Go to Dashboard &rarr;
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                                Create Account
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg px-4">
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Right: Feature Cards -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold mb-4 text-dark">Core Capabilities</h5>
                        
                        <div class="d-flex align-items-start mb-3">
                            <div class="badge bg-success-subtle text-success p-2 rounded-3 me-3 fs-6">✓</div>
                            <div>
                                <h6 class="fw-semibold mb-1">Live Position Tracking</h6>
                                <p class="small text-muted mb-0">Automatically calculates net balances so you always know your surplus or deficit.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            <div class="badge bg-primary-subtle text-primary p-2 rounded-3 me-3 fs-6">✓</div>
                            <div>
                                <h6 class="fw-semibold mb-1">PKR Currency Display</h6>
                                <p class="small text-muted mb-0">Clear visual distinction between positive credits (+Rs.) and debts (-Rs.).</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="badge bg-warning-subtle text-warning p-2 rounded-3 me-3 fs-6">✓</div>
                            <div>
                                <h6 class="fw-semibold mb-1">Settlement Management</h6>
                                <p class="small text-muted mb-0">Toggle transaction status between pending and settled with a single click.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-3 text-center text-muted small mt-auto">
        &copy; {{ date('Y') }} Ledger+. All rights reserved.
    </footer>
</body>
</html>