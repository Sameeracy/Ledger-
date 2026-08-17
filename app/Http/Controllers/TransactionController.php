<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\TransactionService;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService,
        protected TransactionRepositoryInterface $transactionRepo
    ) {}

    /**
     * Display the main Ledger Dashboard.
     */
    public function index(Request $request)
    {
        $data = $this->transactionService->getDashboardMetrics(
            Auth::user(),
            $request->query('search')
        );

        return view('transactions.index', $data);
    }

    /**
     * Show form to create a new ledger entry.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created transaction.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'person_name'      => 'required|string|max:255',
            'type'             => 'required|in:you_owe,they_owe',
            'amount'           => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
        ]);

        $this->transactionRepo->createForUser(Auth::user(), $validated);

        return redirect()->route('transactions.index')->with('success', 'Record added successfully.');
    }

    /**
     * Show form to edit an existing transaction.
     */
    public function edit(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update an existing transaction.
     */
    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'person_name'      => 'required|string|max:255',
            'type'             => 'required|in:you_owe,they_owe',
            'amount'           => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'status'           => 'required|in:pending,settled',
        ]);

        $this->transactionRepo->update($transaction, $validated);

        return redirect()->route('transactions.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Quick toggle for marking as settled / pending.
     */
    public function toggleStatus(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $this->transactionService->toggleStatus($transaction);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    /**
     * Delete a transaction.
     */
    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $this->transactionRepo->delete($transaction);

        return redirect()->route('transactions.index')->with('success', 'Record deleted successfully.');
    }
}