<x-app-layout>
    <x-slot name="header">
        <div class="page-heading-copy">
            <span class="page-icon text-success" style="background: rgba(15, 118, 110, 0.12); color: #0f766e;">
                <i class="bi bi-arrow-down-left-circle-fill" aria-hidden="true"></i>
            </span>
            <div>
                <p class="eyebrow mb-1 text-success">Receivables</p>
                <h1 class="h3 mb-0">Credits (They Owe Me)</h1>
            </div>
        </div>
        <div class="heading-actions">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Add Credit Record
            </a>
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> All Records
            </a>
        </div>
    </x-slot>

    <!-- Top Metric Banner -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="metric-card metric-success h-100">
                <div class="metric-top">
                    <span class="metric-label">Active Receivables</span>
                    <span class="metric-icon"><i class="bi bi-arrow-down-left-circle-fill" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value text-success">
                    +Rs. {{ number_format($totalPending, 2) }}
                </div>
                <div class="metric-meta">
                    <span>Total pending amount owed to you</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="panel mb-4">
        <form method="GET" action="{{ route('transactions.credits') }}" class="row g-2 align-items-center">
            <div class="col-12 col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="search" 
                           name="search" 
                           value="{{ request('search') }}" 
                           class="form-control border-start-0 ps-0" 
                           placeholder="Search credit records by title or person...">
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="bi bi-filter me-1"></i> Search
                </button>
                @if (request()->filled('search'))
                    <a href="{{ route('transactions.credits') }}" class="btn btn-outline-secondary" title="Reset filter">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Credits Table Panel -->
    <div class="panel">
        <div class="panel-header">
            <div>
                <h2 class="h5 mb-1 section-title">
                    <i class="bi bi-arrow-down-left-circle text-success" aria-hidden="true"></i>
                    <span>Credit Records</span>
                </h2>
                <p class="text-muted small mb-0">All money that other people owe you.</p>
            </div>
            <span class="badge badge-count">
                {{ $transactions->total() }} Records
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">Date</th>
                        <th>Title / Reason</th>
                        <th>Debtor (Who Owes You)</th>
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
                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('M d, Y') }}
                            </td>
                            <td class="fw-bold text-body">{{ $transaction->title }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="counterparty-avatar">
                                        {{ strtoupper(substr($transaction->person_name, 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold">{{ $transaction->person_name }}</span>
                                </div>
                            </td>
                            <td class="text-success fw-bold fs-6">+Rs. {{ number_format($transaction->amount, 2) }}</td>
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
                                    <form method="POST" action="{{ route('transactions.destroy', $transaction) }}" class="d-inline" onsubmit="return confirm('Delete this record?');">
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
                            <td colspan="6" class="text-center py-5">
                                <div class="blank-state mx-auto">
                                    <div class="page-icon mx-auto mb-3" style="width: 56px; height: 56px; font-size: 1.5rem;">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                    <h5 class="fw-bold mb-1">No Credit Records Found</h5>
                                    <p class="text-muted small mb-3">You do not have any credit records listed.</p>
                                    <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-lg me-1"></i> Add New Credit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

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