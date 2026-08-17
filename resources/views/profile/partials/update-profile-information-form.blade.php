<section>
    <header class="mb-4">
        <h5 class="fw-bold mb-1">Profile Information</h5>
        <p class="text-muted small mb-0">Update your account's profile information and email address.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" 
                   class="form-control w-100 @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $user->name) }}" 
                   required 
                   autofocus 
                   autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" 
                   class="form-control w-100 @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email" 
                   value="{{ old('email', $user->email) }}" 
                   required 
                   autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-3 mb-0" role="alert">
                    <p class="mb-1 small">Your email address is unverified.</p>
                    <button form="send-verification" class="btn btn-sm btn-link p-0">
                        Click here to re-send the verification email.
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success small fw-semibold mb-0">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 pt-2">
            <button type="submit" class="btn btn-primary px-4">Save</button>
            @if (session('status') === 'profile-updated')
                <span class="text-success small fw-semibold">Saved.</span>
            @endif
        </div>
    </form>
</section>