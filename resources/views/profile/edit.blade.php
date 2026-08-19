<x-app-layout>
    <x-slot name="header">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Account</p>
                <h1 class="h3 mb-0">Profile Settings</h1>
            </div>
        </div>
        <div class="heading-actions">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Dashboard
            </a>
        </div>
    </x-slot>

    <div class="row g-4">
        <!-- Left: Profile Summary Card -->
        <div class="col-12 col-xl-4">
            <div class="panel profile-card h-100">
                <div class="pb-3 border-bottom mb-3 text-center">
                    <h2 class="h5 mb-1 fw-bold">{{ $user->name }}</h2>
                    <p class="text-muted small mb-0">{{ $user->email }}</p>
                </div>

                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge text-bg-primary">Account Owner</span>
                    <span class="badge text-bg-success">Active</span>
                </div>

                <div class="info-list text-start mt-4">
                    <div>
                        <span>Member Since</span>
                        <strong>{{ $user->created_at->format('M Y') }}</strong>
                    </div>
                    <div>
                        <span>Email Status</span>
                        <strong class="text-success">Verified</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Profile Settings Forms -->
        <div class="col-12 col-xl-8">
            <div class="d-grid gap-4">
                <!-- Profile Information -->
                <div class="panel">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password -->
                <div class="panel">
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Delete Account Danger Zone -->
                <div class="panel" style="border-left: 4px solid var(--admin-danger);">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>