<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Models\User;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getPaginatedForUser(User $user, ?string $search = null, ?string $type = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = $user->transactions();

        if ($type) {
            $query->where('type', $type);
        }

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        return $query->orderBy('transaction_date', 'desc')
                    ->paginate($perPage)
                    ->withQueryString();
    }

    public function getPendingSumByType(User $user, string $type): float
    {
        return (float) $user->transactions()
                            ->where('type', $type)
                            ->where('status', 'pending')
                            ->sum('amount');
    }

    public function createForUser(User $user, array $data): Transaction
    {
        return $user->transactions()->create($data);
    }

    public function update(Transaction $transaction, array $data): bool
    {
        return $transaction->update($data);
    }

    public function delete(Transaction $transaction): ?bool
    {
        return $transaction->delete();
    }
    public function getAllForUser(User $user)
    {
        return $user->transactions()
                    ->orderBy('transaction_date', 'desc')
                    ->get();
    }
}