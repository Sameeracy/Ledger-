<x-guest-layout>
    <div class="mb-4">
        <p class="eyebrow mb-1">Security</p>
        <h1 class="h4 mb-1 fw-bold">Reset Password</h1>
        <p class="text-muted small mb-0">Create a new secure password for your account.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="needs-validation">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email address</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-envelope"></i></span>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $request->email) }}" 
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
            <label for="password" class="form-label fw-semibold">New Password</label>
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
            <label for="password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
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
            <i class="bi bi-key me-1"></i> Reset Password
        </button>
    </form>
</x-guest-layout>
