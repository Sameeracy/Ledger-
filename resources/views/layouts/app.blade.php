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
    <body class="bg-light min-vh-100 d-flex flex-column">

        <!-- Top Navigation -->
        <nav class="navbar navbar-expand navbar-dark bg-dark shadow-sm px-3">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Ledger<span class="text-primary">+</span></a>
            
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"> Profile Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger"> Log Out</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- App Body: Sidebar + Main Content -->
        <div class="container-fluid flex-grow-1">
            <div class="row min-vh-100">
                
                <!-- Side Navbar -->
                <nav class="col-md-3 col-lg-2 d-md-block bg-light border-end py-4 px-3 text-center">
                    <div class="d-grid mb-3">
                        <a href="{{ route('transactions.create') }}" class="btn btn-primary fw-semibold">
                            + New Record
                        </a>
                    </div>

                    <div class="list-group list-group-flush text-center">
                        <a href="{{ route('dashboard') }}" 
                        class="list-group-item list-group-item-action border-0 rounded-3 py-2 mb-1 {{ request()->routeIs('dashboard') ? 'active bg-primary text-white' : 'text-dark' }}">
                             Overview
                        </a>
                        <a href="{{ route('transactions.credits') }}" 
                        class="list-group-item list-group-item-action border-0 rounded-3 py-2 mb-1 {{ request()->routeIs('transactions.credits') ? 'active bg-success text-white' : 'text-dark' }}">
                             Credits
                        </a>
                        <a href="{{ route('transactions.debits') }}" 
                        class="list-group-item list-group-item-action border-0 rounded-3 py-2 mb-1 {{ request()->routeIs('transactions.debits') ? 'active bg-danger text-white' : 'text-dark' }}">
                             Debits
                        </a>
                    </div>

                    <hr class="my-3 text-muted">

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard.export-pdf') }}" class="btn btn-outline-danger fw-semibold">
                             Export PDF
                        </a>
                        <a href="{{ route('transactions.export') }}" class="btn btn-outline-success fw-semibold">
                             Export to Excel
                        </a>
                    </div>
                </nav>

                <!-- Main Content Area -->
                <main class="col-md-9 col-lg-10 px-md-4 py-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{ $slot }}
                </main>

            </div>
        </div>

        <footer class="bg-white border-top py-3 text-center text-muted small mt-auto">
            &copy; {{ date('Y') }} Ledger+. All rights reserved.
        </footer>
    </body>
    </html>