<?php

namespace App\Services;

use App\Models\User;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionService
{
    public function __construct(
        protected TransactionRepositoryInterface $transactionRepo
    ) {}

    public function getDashboardMetrics(User $user, ?string $search = null): array
    {
        $transactions = $this->transactionRepo->getPaginatedForUser($user, $search);
        $theyOwe = $this->transactionRepo->getPendingSumByType($user, 'they_owe');
        $youOwe = $this->transactionRepo->getPendingSumByType($user, 'you_owe');
        $netBalance = $theyOwe - $youOwe;

        return compact('transactions', 'theyOwe', 'youOwe', 'netBalance');
    }

    public function toggleStatus(Transaction $transaction): void
    {
        $newStatus = $transaction->status === 'pending' ? 'settled' : 'pending';
        $this->transactionRepo->update($transaction, ['status' => $newStatus]);
    }
}