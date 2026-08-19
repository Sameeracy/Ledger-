<x-guest-layout>
    <div class="mb-4">
        <p class="eyebrow mb-1">Account Recovery</p>
        <h1 class="h4 mb-1 fw-bold">Forgot Password</h1>
        <p class="text-muted small mb-0">Enter your email and we'll send you a password reset link.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4 d-flex align-items-center py-2 px-3 small" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{{ session('status') }}</div>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="needs-validation">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
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
                       autofocus>
            </div>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-envelope-arrow-up me-1"></i> Send Password Reset Link
        </button>
    </form>

    <div class="auth-footer">
        Remembered your password? <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">Back to login</a>
    </div>
</x-guest-layout>
