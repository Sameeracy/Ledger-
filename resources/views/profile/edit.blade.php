<x-app-layout>
    <x-slot name="header">
        <h4 class="mb-0 fw-bold">Profile Settings</h4>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Profile Information -->
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="card border-0 shadow-sm rounded-3 border-start border-danger border-4">
                <div class="card-body p-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>