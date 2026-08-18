<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaction; // Or your actual Record/Transaction model

class DashboardController extends Controller
{
    public function exportPdf()
    {
        $user = auth()->user();

        // 1. Fetch all user transactions sorted by transaction_date
        $records = Transaction::where('user_id', $user->id)
            ->latest('transaction_date')
            ->get();

        // 2. Exact Card Calculations matching your dashboard
        $peopleOweYou = Transaction::where('user_id', $user->id)
            ->where('status', 'pending')
            ->where('type', 'they_owe')
            ->sum('amount');

        $youOweOthers = Transaction::where('user_id', $user->id)
            ->where('status', 'pending')
            ->where('type', 'you_owe')
            ->sum('amount');

        $overallPosition = $peopleOweYou - $youOweOthers;

        $cards = [
            'people_owe_you'   => $peopleOweYou,
            'you_owe_others'   => $youOweOthers,
            'overall_position' => $overallPosition,
        ];

        $pdf = Pdf::loadView('reports.dashboard-pdf', compact('user', 'records', 'cards'));

        return $pdf->download('ledger-report-' . now()->format('Y-m-d') . '.pdf');
    }
}