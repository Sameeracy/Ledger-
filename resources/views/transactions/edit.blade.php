<x-app-layout>
    <x-slot name="header">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-pencil-square" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Modify Entry</p>
                <h1 class="h3 mb-0">Edit Ledger Record</h1>
            </div>
        </div>
        <div class="heading-actions">
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back to Ledger
            </a>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title">
                            <i class="bi bi-pencil"></i>
                            <span>Update Transaction</span>
                        </h2>
                        <p class="text-muted small mb-0">Modify details, amount, or settlement status for this record.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('transactions.update', $transaction) }}" class="needs-validation">
                    @csrf
                    @method('PUT')

                    <!-- Transaction Type Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-block mb-2">Transaction Type</label>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="mini-card d-flex align-items-center gap-3 p-3 h-100 rounded-3 border cursor-pointer" for="type_they_owe" style="cursor: pointer;">
                                    <input class="form-check-input mt-0" 
                                           type="radio" 
                                           name="type" 
                                           id="type_they_owe" 
                                           value="they_owe" 
                                           {{ old('type', $transaction->type) === 'they_owe' ? 'checked' : '' }}>
                                    <div>
                                        <strong class="d-block text-success fw-bold">
                                            <i class="bi bi-arrow-down-left-circle me-1"></i> They Owe Me (+)
                                        </strong>
                                        <span class="small text-muted">Credit / Receivable money</span>
                                    </div>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="mini-card d-flex align-items-center gap-3 p-3 h-100 rounded-3 border cursor-pointer" for="type_you_owe" style="cursor: pointer;">
                                    <input class="form-check-input mt-0" 
                                           type="radio" 
                                           name="type" 
                                           id="type_you_owe" 
                                           value="you_owe" 
                                           {{ old('type', $transaction->type) === 'you_owe' ? 'checked' : '' }}>
                                    <div>
                                        <strong class="d-block text-danger fw-bold">
                                            <i class="bi bi-arrow-up-right-circle me-1"></i> I Owe Them (-)
                                        </strong>
                                        <span class="small text-muted">Debit / Payable money</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        @error('type')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Title / Description</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent text-muted"><i class="bi bi-pencil-square"></i></span>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $transaction->title) }}" 
                                   required>
                        </div>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Person Name -->
                    <div class="mb-3">
                        <label for="person_name" class="form-label fw-semibold">Person Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent text-muted"><i class="bi bi-person"></i></span>
                            <input type="text" 
                                   class="form-control @error('person_name') is-invalid @enderror" 
                                   id="person_name" 
                                   name="person_name" 
                                   value="{{ old('person_name', $transaction->person_name) }}" 
                                   required>
                        </div>
                        @error('person_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Amount -->
                        <div class="col-sm-6">
                            <label for="amount" class="form-label fw-semibold">Amount (PKR)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-muted fw-bold">Rs.</span>
                                <input type="number" 
                                       step="0.01" 
                                       min="0.01" 
                                       class="form-control @error('amount') is-invalid @enderror" 
                                       id="amount" 
                                       name="amount" 
                                       value="{{ old('amount', $transaction->amount) }}" 
                                       required>
                            </div>
                            @error('amount')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="col-sm-6">
                            <label for="transaction_date" class="form-label fw-semibold">Transaction Date</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-calendar3"></i></span>
                                <input type="date" 
                                       class="form-control @error('transaction_date') is-invalid @enderror" 
                                       id="transaction_date" 
                                       name="transaction_date" 
                                       value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" 
                                       required>
                            </div>
                            @error('transaction_date')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="form-label fw-semibold">Settlement Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="pending" {{ old('status', $transaction->status) === 'pending' ? 'selected' : '' }}>
                                Pending (Active / Unsettled)
                            </option>
                            <option value="settled" {{ old('status', $transaction->status) === 'settled' ? 'selected' : '' }}>
                                Settled / Paid in Full
                            </option>
                        </select>
                        @error('status')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary px-4">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check2-circle me-1"></i> Update Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>