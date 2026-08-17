<section>
    <header class="mb-4">
        <h5 class="fw-bold mb-1">Update Password</h5>
        <p class="text-muted small mb-0">Ensure your account is using a long, random password to stay secure.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-semibold">Current Password</label>
            <input type="password" 
                   class="form-control w-100 @error('current_password', 'updatePassword') is-invalid @enderror" 
                   id="update_password_current_password" 
                   name="current_password" 
                   autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label fw-semibold">New Password</label>
            <input type="password" 
                   class="form-control w-100 @error('password', 'updatePassword') is-invalid @enderror" 
                   id="update_password_password" 
                   name="password" 
                   autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label fw-semibold">Confirm Password</label>
            <input type="password" 
                   class="form-control w-100 @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                   id="update_password_password_confirmation" 
                   name="password_confirmation" 
                   autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3 pt-2">
            <button type="submit" class="btn btn-primary px-4">Save</button>
            @if (session('status') === 'password-updated')
                <span class="text-success small fw-semibold">Saved.</span>
            @endif
        </div>
    </form>
</section>