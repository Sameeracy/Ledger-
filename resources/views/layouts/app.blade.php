<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon/favicon.png') }}">  
    <title>{{ config('app.name', 'Ledger+') }}</title>

    <!-- Scripts & Styles via Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="admin-shell">
        <!-- Mobile Sidebar Backdrop Overlay -->
        <div class="sidebar-backdrop" data-sidebar-close></div>

        <!-- adminHMD Sidebar Navigation -->
        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
            <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('dashboard') }}" aria-label="Ledger+ dashboard">
                    <span class="brand-icon"><i class="bi bi-wallet2" aria-hidden="true"></i></span>
                    <span class="brand-copy">
                        <span class="brand-title">Ledger<span class="text-primary">+</span></span>
                        <span class="brand-subtitle">Expense & Debt Ledger</span>
                    </span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>
                <a class="nav-link {{ request()->routeIs('transactions.index') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                    <span class="nav-icon"><i class="bi bi-receipt" aria-hidden="true"></i></span>
                    <span class="nav-text">All Records</span>
                </a>
                <a class="nav-link {{ request()->routeIs('transactions.credits') ? 'active' : '' }}" href="{{ route('transactions.credits') }}">
                    <span class="nav-icon"><i class="bi bi-arrow-down-left-circle" aria-hidden="true"></i></span>
                    <span class="nav-text">Credits (+Rs.)</span>
                </a>
                <a class="nav-link {{ request()->routeIs('transactions.debits') ? 'active' : '' }}" href="{{ route('transactions.debits') }}">
                    <span class="nav-icon"><i class="bi bi-arrow-up-right-circle" aria-hidden="true"></i></span>
                    <span class="nav-text">Debits (-Rs.)</span>
                </a>
                <a class="nav-link {{ request()->routeIs('transactions.create') ? 'active' : '' }}" href="{{ route('transactions.create') }}">
                    <span class="nav-icon"><i class="bi bi-plus-circle" aria-hidden="true"></i></span>
                    <span class="nav-text">New Record</span>
                </a>
                <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                    <span class="nav-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
                    <span class="nav-text">Profile Settings</span>
                </a>
            </nav>

            <div class="sidebar-user">
                <img class="avatar-img avatar-md sidebar-user-avatar" src="{{ asset('assets/images/avatar/avatar.jpg') }}" alt="{{ Auth::user()->name }}">
                <strong class="text-truncate d-block w-100 px-2">{{ Auth::user()->name }}</strong>
                <small class="text-truncate d-block w-100 px-2 text-muted">{{ Auth::user()->email }}</small>
            </div>

            <div class="sidebar-footer">
                <span class="status-dot"></span>
                <span class="sidebar-footer-text">System Active</span>
            </div>
        </aside>

        <!-- adminHMD Main Shell -->
        <div class="admin-main">
            <!-- Top Navbar -->
            <nav class="navbar admin-navbar navbar-expand bg-white">
                <div class="container-fluid px-3 px-lg-4">
                    <!-- Sidebar Toggle Button -->
                    <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar" aria-expanded="true" aria-label="Toggle sidebar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <!-- Search Bar -->
                    <form class="d-none d-md-flex ms-3 flex-grow-1" role="search" method="GET" action="{{ route('transactions.index') }}">
                        <input class="form-control search-input" type="search" name="search" value="{{ request('search') }}" placeholder="Search transactions by title or person..." aria-label="Search">
                    </form>

                    <!-- Top Navbar Right Actions -->
                    <div class="navbar-actions ms-auto">
                        <!-- Theme Toggle (Light / Dark) -->
                        <button class="icon-button theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
                            <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
                        </button>

                        <!-- Quick Export Dropdown -->
                        <div class="dropdown">
                            <button class="icon-button" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Export Reports">
                                <i class="bi bi-download" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li><h6 class="dropdown-header fw-bold text-body">Export Reports</h6></li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('dashboard.export-pdf') }}">
                                        <i class="bi bi-file-earmark-pdf text-danger me-2"></i>Export Summary PDF
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('transactions.export') }}">
                                        <i class="bi bi-file-earmark-spreadsheet text-success me-2"></i>Export Excel (CSV)
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- User Profile Dropdown -->
                        <div class="dropdown">
                            <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="avatar-img avatar-sm" src="{{ asset('assets/images/avatar/avatar.jpg') }}" alt="{{ Auth::user()->name }}">
                                <span class="profile-name d-none d-sm-inline">{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li>
                                    <div class="px-3 py-2 border-bottom">
                                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                                        <small class="text-muted text-truncate d-block">{{ Auth::user()->email }}</small>
                                    </div>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-gear me-2"></i>Account Settings
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('transactions.index') }}">
                                        <i class="bi bi-list-check me-2"></i>Ledger Records
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Sign out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="dashboard-content">
                <div class="container-fluid px-3 px-lg-4 py-4">
                    @if (isset($header))
                        <div class="page-heading">
                            {{ $header }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4 d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4 d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                            <div>{{ session('error') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>

            <!-- adminHMD Footer -->
            <footer class="admin-footer">
                <div class="container-fluid px-3 px-lg-4">
                    <span>&copy; {{ date('Y') }} Ledger+. All rights reserved.</span>
                    <span>Smart Personal Expense & Debt Manager</span>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>