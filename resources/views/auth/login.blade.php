<x-guest-layout>
    <div class="mb-4">
        <p class="eyebrow mb-1">Secure Access</p>
        <h1 class="h4 mb-1 fw-bold">Sign In</h1>
        <p class="text-muted small mb-0">Enter your credentials to access your ledger.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4 d-flex align-items-center py-2 px-3 small" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{{ session('status') }}</div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="needs-validation">
        @csrf

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
                       autofocus 
                       autocomplete="username">
            </div>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" class="form-label fw-semibold mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a class="small text-decoration-none fw-semibold" href="{{ route('password.request') }}">Forgot?</a>
                @endif
            </div>
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

        <!-- Remember Me -->
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
            <label class="form-check-label text-muted small" for="remember_me">Remember me on this device</label>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
        </button>
    </form>

    @if (Route::has('register'))
        <div class="auth-footer">
            New here? <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">Create an account</a>
        </div>
    @endif
</x-guest-layout>