<x-guest-layout>
    <div class="mb-4">
        <p class="eyebrow mb-1">Confirmation Required</p>
        <h1 class="h4 mb-1 fw-bold">Confirm Password</h1>
        <p class="text-muted small mb-0">This is a secure area. Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="needs-validation">
        @csrf

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-semibold">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-lock"></i></span>
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="password" 
                       name="password" 
                       placeholder="••••••••"
                       required 
                       autocomplete="current-password">
            </div>
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-check2-circle me-1"></i> Confirm
        </button>
    </form>
</x-guest-layout>
