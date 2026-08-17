<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Add Ledger Record</h4>
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary btn-sm">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Title / Description</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="e.g., Dinner bill, Project advance" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Person Name -->
                        <div class="mb-3">
                            <label for="person_name" class="form-label fw-semibold">Person Name</label>
                            <input type="text" 
                                   class="form-control @error('person_name') is-invalid @enderror" 
                                   id="person_name" 
                                   name="person_name" 
                                   value="{{ old('person_name') }}" 
                                   placeholder="e.g., John Doe" 
                                   required>
                            @error('person_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold d-block">Transaction Type</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="type" 
                                       id="type_they_owe" 
                                       value="they_owe" 
                                       {{ old('type', 'they_owe') === 'they_owe' ? 'checked' : '' }}>
                                <label class="form-check-label text-success fw-semibold" for="type_they_owe">
                                    They Owe Me (+)
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="type" 
                                       id="type_you_owe" 
                                       value="you_owe" 
                                       {{ old('type') === 'you_owe' ? 'checked' : '' }}>
                                <label class="form-check-label text-danger fw-semibold" for="type_you_owe">
                                    I Owe Them (-)
                                </label>
                            </div>
                            @error('type')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div class="mb-3">
                            <label for="amount" class="form-label fw-semibold">Amount (PKR)</label>
                            <input type="number" 
                                step="0.01" 
                                min="0.01" 
                                class="form-control @error('amount') is-invalid @enderror" 
                                id="amount" 
                                name="amount" 
                                value="{{ old('amount') }}" 
                                placeholder="0.00" 
                                required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Transaction Date -->
                        <div class="mb-4">
                            <label for="transaction_date" class="form-label fw-semibold">Date</label>
                            <input type="date" 
                                   class="form-control @error('transaction_date') is-invalid @enderror" 
                                   id="transaction_date" 
                                   name="transaction_date" 
                                   value="{{ old('transaction_date', date('Y-m-d')) }}" 
                                   required>
                            @error('transaction_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            Save Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>