<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ledger+ | Smart Debt & Expense Tracking</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon/favicon.png') }}">  
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="min-vh-100 d-flex flex-column">

    <!-- Top Navigation Bar -->
    <nav class="navbar admin-navbar navbar-expand-lg bg-white sticky-top">
        <div class="container px-3 px-lg-4">
            <a class="brand-mark text-decoration-none" href="{{ url('/') }}">
                <span class="brand-icon"><i class="bi bi-wallet2" aria-hidden="true"></i></span>
                <span class="brand-copy">
                    <span class="brand-title">Ledger<span class="text-primary">+</span></span>
                    <span class="brand-subtitle">Smart Debt & Expense Manager</span>
                </span>
            </a>

            <div class="d-flex align-items-center gap-2 ms-auto">
                <!-- Theme Toggle Button -->
                <button class="icon-button theme-toggle me-2" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
                    <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
                </button>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-person-plus me-1"></i> Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Hero Section -->
    <main class="flex-grow-1 d-flex align-items-center py-5">
        <div class="container px-3 px-lg-4">
            <div class="row align-items-center justify-content-between g-5">
                
                <!-- Left: Hero Copy & Actions -->
                <div class="col-lg-6">
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3 fw-bold">
                        <i class="bi bi-shield-check me-1"></i> Personal Expense & Debt Manager
                    </span>
                    <h1 class="display-5 fw-bold mb-3">
                        Track who owes you and what you owe.
                    </h1>
                    <p class="lead text-muted mb-4">
                        <strong>Ledger+</strong> gives you crystal-clear transparency over shared bills, loans, and credit balances. Enjoy real-time surplus/deficit calculations, instant search filtering, and one-click settlement tracking with a modern admin interface.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4">
                                Go to Dashboard <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4">
                                <i class="bi bi-person-plus me-1"></i> Create Free Account
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg px-4">
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Right: Feature Cards & Visuals -->
                <div class="col-lg-5">
                    <div class="panel">
                        <div class="panel-header mb-4">
                            <div>
                                <h5 class="fw-bold mb-1 section-title">
                                    <i class="bi bi-stars text-primary"></i>
                                    <span>Core Capabilities</span>
                                </h5>
                                <p class="text-muted small mb-0">Built with modern admin tools to simplify money management.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start gap-3 mb-4">
                            <div class="metric-icon" style="background: rgba(15, 118, 110, 0.12); color: #0f766e; width: 44px; height: 44px;">
                                <i class="bi bi-arrow-down-left-circle-fill fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Live Position & Net Balance</h6>
                                <p class="small text-muted mb-0">Automatically calculates net balances so you always know whether you are in surplus or deficit.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 mb-4">
                            <div class="metric-icon" style="background: rgba(37, 99, 235, 0.12); color: #2563eb; width: 44px; height: 44px;">
                                <i class="bi bi-cash-stack fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">PKR Currency & Custom Tracking</h6>
                                <p class="small text-muted mb-0">Clear visual distinction between incoming receivables (+Rs.) and outgoing debts (-Rs.).</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="metric-icon" style="background: rgba(217, 119, 6, 0.12); color: #d97706; width: 44px; height: 44px;">
                                <i class="bi bi-check2-circle fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">One-Click Settlement & Exports</h6>
                                <p class="small text-muted mb-0">Mark debts as settled in a single tap, or export your summary report directly to PDF and Excel.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="admin-footer mt-auto">
        <div class="container px-3 px-lg-4 d-flex justify-content-between align-items-center">
            <span>&copy; {{ date('Y') }} Ledger+. All rights reserved.</span>
            <span>Styled with adminHMD</span>
        </div>
    </footer>
</body>
</html>