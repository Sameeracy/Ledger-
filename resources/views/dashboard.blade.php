<x-app-layout>
    <x-slot name="header">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Welcome Back</p>
                <h1 class="h3 mb-0">Dashboard</h1>
            </div>
        </div>
        <div class="heading-actions">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> New Transaction
            </a>
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-receipt me-1"></i> View All Records
            </a>
        </div>
    </x-slot>

    <div class="row g-4 mb-4">
        <!-- Welcome Hero Panel -->
        <div class="col-12 col-lg-8">
            <div class="panel h-100">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="brand-icon" style="width: 48px; height: 48px;">
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Welcome back, {{ Auth::user()->name }}!</h4>
                        <p class="text-muted small mb-0">Your personal ledger is up to date and active.</p>
                    </div>
                </div>
                <p class="text-muted">
                    Track money you are owed by friends, family, or clients, and keep clean records of any balances you need to pay back. Toggle settlement statuses in real-time or export reports directly.
                </p>
                <div class="d-flex flex-wrap gap-2 pt-2">
                    <a href="{{ route('transactions.credits') }}" class="btn btn-sm btn-outline-success">
                        <i class="bi bi-arrow-down-left me-1"></i> View Credits
                    </a>
                    <a href="{{ route('transactions.debits') }}" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-arrow-up-right me-1"></i> View Debits
                    </a>
                    <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Add New Record
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Info Panel -->
        <div class="col-12 col-lg-4">
            <div class="panel h-100">
                <div class="panel-header mb-3">
                    <h5 class="fw-bold mb-0 section-title">
                        <i class="bi bi-info-circle"></i>
                        <span>System Shortcuts</span>
                    </h5>
                </div>
                <div class="info-list">
                    <div>
                        <span>Export Summary PDF</span>
                        <a href="{{ route('dashboard.export-pdf') }}" class="btn btn-sm btn-light text-danger">
                            <i class="bi bi-file-earmark-pdf"></i> Download
                        </a>
                    </div>
                    <div>
                        <span>Export Excel (CSV)</span>
                        <a href="{{ route('transactions.export') }}" class="btn btn-sm btn-light text-success">
                            <i class="bi bi-file-earmark-spreadsheet"></i> Download
                        </a>
                    </div>
                    <div>
                        <span>Account Profile</span>
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-light">
                            <i class="bi bi-person-gear"></i> Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>