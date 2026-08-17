<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-success mb-1">Credits (Money Owed to You)</h3>
            <p class="text-muted small mb-0">Total Active Credits: <strong>+Rs. {{ number_format($totalPending, 2) }}</strong></p>
        </div>
        <form method="GET" action="{{ route('transactions.credits') }}" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by title..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary btn-sm">Search</button>
            @if(request('search'))
                <a href="{{ route('transactions.credits') }}" class="btn btn-sm btn-link text-muted">Clear</a>
            @endif
        </form>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Debtor (Person)</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('M d, Y') }}</td>
                            <td class="fw-semibold">{{ $transaction->title }}</td>
                            <td>{{ $transaction->person_name }}</td>
                            <td class="text-success fw-bold">+Rs. {{ number_format($transaction->amount, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('transactions.toggle-status', $transaction) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm badge rounded-pill border-0 {{ $transaction->status === 'settled' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ ucfirst($transaction->status) }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                                <form method="POST" action="{{ route('transactions.destroy', $transaction) }}" class="d-inline" onsubmit="return confirm('Delete this record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No credit records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($transactions->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</x-app-layout>