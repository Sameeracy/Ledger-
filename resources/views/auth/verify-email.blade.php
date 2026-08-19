<x-guest-layout>
    <div class="mb-4">
        <p class="eyebrow mb-1">Verification</p>
        <h1 class="h4 mb-1 fw-bold">Verify Your Email</h1>
        <p class="text-muted small mb-0">Thanks for signing up! Before getting started, please check your inbox and click the verification link we emailed you.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success d-flex align-items-center py-2 px-3 small mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>A new verification link has been sent to the email address provided.</div>
        </div>
    @endif

    <div class="d-grid gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary w-100 py-2">
                <i class="bi bi-send me-1"></i> Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="btn btn-link text-muted small text-decoration-none">
                <i class="bi bi-box-arrow-right me-1"></i> Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
