<x-guest-layout>
    <!-- Card Header Subtitle -->
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark mb-1">Sign In</h4>
        <p class="text-muted small mb-0">Enter your credentials to access your ledger</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                <label class="form-check-label text-muted small" for="remember_me">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-decoration-none small" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Sign in</button>

        @if (Route::has('register'))
            <p class="text-center text-muted small mb-0">
                Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Sign up</a>
            </p>
        @endif
    </form>
</x-guest-layout>