<section>
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-shield-lock"></i>
                <span>Update Password</span>
            </h2>
            <p class="text-muted small mb-0">Ensure your account is using a long, random password to stay secure.</p>
        </div>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="needs-validation">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-semibold">Current Password</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-lock"></i></span>
                <input type="password" 
                       class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                       id="update_password_current_password" 
                       name="current_password" 
                       placeholder="••••••••"
                       autocomplete="current-password">
            </div>
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label fw-semibold">New Password</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-key"></i></span>
                <input type="password" 
                       class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                       id="update_password_password" 
                       name="password" 
                       placeholder="••••••••"
                       autocomplete="new-password">
            </div>
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-semibold">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-shield-check"></i></span>
                <input type="password" 
                       class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                       id="update_password_password_confirmation" 
                       name="password_confirmation" 
                       placeholder="••••••••"
                       autocomplete="new-password">
            </div>
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3 pt-2 border-top">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check2-circle me-1"></i> Update Password
            </button>
            @if (session('status') === 'password-updated')
                <span class="text-success small fw-semibold">
                    <i class="bi bi-check-circle me-1"></i> Password updated successfully.
                </span>
            @endif
        </div>
    </form>
</section>