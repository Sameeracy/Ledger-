<x-app-layout>
    <x-slot name="header">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Financial Overview</p>
                <h1 class="h3 mb-0">Expense & Debt Ledger</h1>
            </div>
        </div>
        <div class="heading-actions">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Add Record
            </a>
            <a href="{{ route('dashboard.export-pdf') }}" class="btn btn-outline-secondary">
                <i class="bi bi-file-earmark-pdf text-danger me-1"></i> PDF
            </a>
            <a href="{{ route('transactions.export') }}" class="btn btn-outline-secondary">
                <i class="bi bi-file-earmark-spreadsheet text-success me-1"></i> Excel
            </a>
        </div>
    </x-slot>

    <!-- 1. adminHMD Metric Cards -->
    <div class="row g-3 mb-4">
        <!-- Metric: Credits (They Owe Me) -->
        <div class="col-12 col-md-4">
            <div class="metric-card metric-success h-100">
                <div class="metric-top">
                    <span class="metric-label">Credit (They Owe)</span>
                    <span class="metric-icon"><i class="bi bi-arrow-down-left-circle-fill" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value text-success">
                    +Rs. {{ number_format($theyOwe, 2) }}
                </div>
                <div class="metric-meta">
                    <span class="badge bg-success-subtle text-success border border-success-subtle">
                        <i class="bi bi-arrow-down-left me-1"></i>Receivable
                    </span>
                    <span>Total Active Credits</span>
                </div>
            </div>
        </div>

        <!-- Metric: Debits (You Owe) -->
        <div class="col-12 col-md-4">
            <div class="metric-card metric-danger h-100">
                <div class="metric-top">
                    <span class="metric-label">Debit (You Owe)</span>
                    <span class="metric-icon"><i class="bi bi-arrow-up-right-circle-fill" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value text-danger">
                    -Rs. {{ number_format($youOwe, 2) }}
                </div>
                <div class="metric-meta">
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                        <i class="bi bi-arrow-up-right me-1"></i>Payable
                    </span>
                    <span>Total Active Debts</span>
                </div>
            </div>
        </div>

        <!-- Metric: Net Overall Position -->
        <div class="col-12 col-md-4">
            <div class="metric-card {{ $netBalance >= 0 ? 'metric-primary' : 'metric-warning' }} h-100">
                <div class="metric-top">
                    <span class="metric-label">Overall Net Position</span>
                    <span class="metric-icon"><i class="bi bi-wallet2" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value {{ $netBalance >= 0 ? 'text-primary' : 'text-warning' }}">
                    {{ $netBalance < 0 ? '-' : '+' }}Rs. {{ number_format(abs($netBalance), 2) }}
                </div>
                <div class="metric-meta">
                    <span class="badge {{ $netBalance >= 0 ? 'bg-primary-subtle text-primary border border-primary-subtle' : 'bg-warning-subtle text-warning border border-warning-subtle' }}">
                        {{ $netBalance >= 0 ? 'Surplus' : 'Deficit' }}
                    </span>
                    <span>Net Balance Calculation</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Search & Filter Bar -->
    <div class="panel mb-4">
        <form method="GET" action="{{ route('transactions.index') }}" class="row g-2 align-items-center">
            <div class="col-12 col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="search" 
                           name="search" 
                           value="{{ request('search') }}" 
                           class="form-control border-start-0 ps-0" 
                           placeholder="Search record by title, person name, or notes...">
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="bi bi-filter me-1"></i> Filter
                </button>
                @if (request()->filled('search'))
                    <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary" title="Reset filter">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- 3. Ledger Records Table Panel -->
    <div class="panel">
        <div class="panel-header">
            <div>
                <h2 class="h5 mb-1 section-title">
                    <i class="bi bi-receipt" aria-hidden="true"></i>
                    <span>All Ledger Records</span>
                </h2>
                <p class="text-muted small mb-0">List of all recorded financial transactions, receivables, and payables.</p>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="badge badge-count">
                    {{ $transactions->total() }} Total Entries
                </span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">Date</th>
                        <th>Title / Description</th>
                        <th>Person (Counterparty)</th>
                        <th>Type</th>
                        <th>Amount (PKR)</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td class="ps-3 text-muted small whitespace-nowrap">
                                <i class="bi bi-calendar3 me-1 text-muted"></i>
                                {{ $transaction->transaction_date->format('M d, Y') }}
                            </td>
                            <td>
                                <div class="fw-bold text-body">{{ $transaction->title }}</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="counterparty-avatar">
                                        {{ strtoupper(substr($transaction->person_name, 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold">{{ $transaction->person_name }}</span>
                                </div>
                            </td>
                            <td>
                                @if ($transaction->type === 'they_owe')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">
                                        <i class="bi bi-arrow-down-left me-1"></i> Credit (They Owe)
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                        <i class="bi bi-arrow-up-right me-1"></i> Debit (You Owe)
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($transaction->type === 'they_owe')
                                    <span class="text-success fw-bold fs-6">
                                        +Rs. {{ number_format($transaction->amount, 2) }}
                                    </span>
                                @else
                                    <span class="text-danger fw-bold fs-6">
                                        -Rs. {{ number_format($transaction->amount, 2) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('transactions.toggle-status', $transaction) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="btn btn-sm {{ $transaction->status === 'settled' ? 'btn-success text-white' : 'btn-outline-warning' }} rounded-pill px-3 py-1" 
                                            style="font-size: 0.78rem;" 
                                            title="Click to toggle status">
                                        <i class="bi {{ $transaction->status === 'settled' ? 'bi-check-circle-fill' : 'bi-clock-history' }} me-1"></i>
                                        {{ ucfirst($transaction->status) }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end pe-3">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-light" title="Edit Record">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('transactions.destroy', $transaction) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Delete Record">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="blank-state mx-auto">
                                    <div class="page-icon mx-auto mb-3" style="width: 56px; height: 56px; font-size: 1.5rem;">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <h5 class="fw-bold mb-1">No Ledger Records Found</h5>
                                    <p class="text-muted small mb-3">
                                        {{ request('search') ? 'No results matched your search criteria.' : 'You have not added any transactions yet.' }}
                                    </p>
                                    <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-lg me-1"></i> Create First Record
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($transactions->hasPages())
            <div class="d-flex justify-content-between align-items-center pt-4 border-top mt-3 px-2">
                <small class="text-muted">
                    Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} results
                </small>
                <div>
                    {{ $transactions->links() }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>