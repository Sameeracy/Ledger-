<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TransactionRepositoryInterface
{
    public function getPaginatedForUser(User $user, ?string $search = null, int $perPage = 10): LengthAwarePaginator;
    public function getPendingSumByType(User $user, string $type): float;
    public function createForUser(User $user, array $data): Transaction;
    public function update(Transaction $transaction, array $data): bool;
    public function delete(Transaction $transaction): ?bool;
}