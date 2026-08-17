<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Expense & Debt Ledger</h4>
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                + Add Record
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 1. Top Summary Metric Cards -->
    <!-- 1. Top Summary Metric Cards -->
    <div class="row g-3 mb-4">
        <!-- They Owe Me -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 border-start border-success border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-semibold">People Owe You</span>
                    <h3 class="text-success fw-bold mt-2 mb-0">
                        +Rs. {{ number_format($theyOwe, 2) }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- You Owe -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 border-start border-danger border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-semibold">You Owe Others</span>
                    <h3 class="text-danger fw-bold mt-2 mb-0">
                        -Rs. {{ number_format($youOwe, 2) }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Surplus / Deficit -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 border-start {{ $netBalance >= 0 ? 'border-success' : 'border-danger' }} border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-semibold">
                        Overall Position ({{ $netBalance >= 0 ? 'Surplus' : 'Deficit' }})
                    </span>
                    <h3 class="{{ $netBalance >= 0 ? 'text-success' : 'text-danger' }} fw-bold mt-2 mb-0">
                        {{ $netBalance < 0 ? '-' : '+' }}Rs. {{ number_format(abs($netBalance), 2) }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- 2. Search & Filter Bar -->
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('transactions.index') }}" class="row g-2 align-items-center">
                <div class="col-md-10">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           class="form-control" 
                           placeholder="Search record by title...">
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-dark w-100">Search</button>
                    @if (request()->filled('search'))
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Ledger Records Table -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Title</th>
                        <th>Person</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $transaction->title }}</td>
                            <td>{{ $transaction->person_name }}</td>
                            <td>
                                @if ($transaction->type === 'they_owe')
                                    <span class="text-success fw-bold">
                                        +Rs. {{ number_format($transaction->amount, 2) }}
                                    </span>
                                @else
                                    <span class="text-danger fw-bold">
                                        -Rs. {{ number_format($transaction->amount, 2) }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $transaction->transaction_date->format('M d, Y') }}</td>
                            <td>
                                <form method="POST" action="{{ route('transactions.toggle-status', $transaction) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $transaction->status === 'settled' ? 'btn-success' : 'btn-outline-warning' }} rounded-pill px-3 py-0" style="font-size: 0.8rem;">
                                        {{ ucfirst($transaction->status) }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-outline-primary me-1">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('transactions.destroy', $transaction) }}" class="d-inline" onsubmit="return confirm('Delete this record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- 4. Pagination Links -->
        @if ($transactions->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</x-app-layout>