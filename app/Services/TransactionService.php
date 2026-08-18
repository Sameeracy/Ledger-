<?php

namespace App\Services;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\User;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionService
{
    public function __construct(
        protected TransactionRepositoryInterface $transactionRepo
    ) {}

    public function exportAllToExcel(User $user): StreamedResponse
    {
        $transactions = $this->transactionRepo->getAllForUser($user);
        $filename = 'Ledger_Export_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $callback = function () use ($transactions) {
            $file = fopen('php://output', 'w');

            // Output UTF-8 BOM for proper character encoding in Microsoft Excel
            fputs($file, "\xEF\xBB\xBF");

            // All Dashboard Columns
            fputcsv($file, [
                'Date',
                'Title',
                'Person Name',
                'Type',
                'Amount (PKR)',
                'Status',
            ]);

            foreach ($transactions as $transaction) {
                $formattedAmount = ($transaction->type === 'they_owe' ? '+Rs. ' : '-Rs. ') . number_format($transaction->amount, 2);
                $formattedType   = $transaction->type === 'they_owe' ? 'Credit (They Owe You)' : 'Debit (You Owe Others)';

                fputcsv($file, [
                    \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d'),
                    $transaction->title,
                    $transaction->person_name,
                    $formattedType,
                    $formattedAmount,
                    ucfirst($transaction->status),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

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
    public function getTransactionsByType(User $user, string $type, ?string $search = null): array
    {
        $transactions = $this->transactionRepo->getPaginatedForUser($user, $search, $type);
        $totalPending = $this->transactionRepo->getPendingSumByType($user, $type);

        return compact('transactions', 'totalPending', 'type');
    }
}