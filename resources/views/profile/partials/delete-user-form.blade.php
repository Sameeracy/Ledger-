<section>
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title text-danger">
                <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                <span>Delete Account</span>
            </h2>
            <p class="text-muted small mb-0">
                Once your account is deleted, all of your ledger data, loans, and credit records will be permanently removed.
            </p>
        </div>
    </div>

    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        <i class="bi bi-trash me-1"></i> Delete Account
    </button>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="confirmUserDeletionModalLabel">
                            <i class="bi bi-exclamation-octagon text-danger me-2"></i>Delete Account Confirmation
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small mb-3">
                            Are you sure you want to permanently delete your account? Please enter your current password below to confirm this irreversible action.
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" 
                                   class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Enter your password">
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> Permanently Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>