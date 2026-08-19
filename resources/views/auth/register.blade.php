<x-guest-layout>
    <div class="mb-4">
        <p class="eyebrow mb-1">Get Started</p>
        <h1 class="h4 mb-1 fw-bold">Create Account</h1>
        <p class="text-muted small mb-0">Start tracking your personal loans and debts.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="needs-validation">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Full Name</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-person"></i></span>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       placeholder="e.g. John Doe"
                       required 
                       autofocus 
                       autocomplete="name">
            </div>
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email address</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-envelope"></i></span>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="name@example.com"
                       required 
                       autocomplete="username">
            </div>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-lock"></i></span>
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="password" 
                       name="password" 
                       placeholder="••••••••"
                       required 
                       autocomplete="new-password">
            </div>
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-shield-check"></i></span>
                <input type="password" 
                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       placeholder="••••••••"
                       required 
                       autocomplete="new-password">
            </div>
            @error('password_confirmation')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-person-plus me-1"></i> Register Account
        </button>
    </form>

    <div class="auth-footer">
        Already registered? <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">Sign in here</a>
    </div>
</x-guest-layout>