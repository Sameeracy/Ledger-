<x-app-layout>
    <x-slot name="header">
        <h4 class="mb-0 fw-semibold">Dashboard</h4>
    </x-slot>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <h5 class="card-title text-success fw-bold">Welcome back, {{ Auth::user()->name }}!</h5>
            <p class="card-text text-muted mb-0">You're logged in and ready to build your application.</p>
        </div>
    </div>
</x-app-layout>