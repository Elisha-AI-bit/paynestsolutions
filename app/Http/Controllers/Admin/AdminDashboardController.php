<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Loan;
use App\Models\Repayment;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_loans' => Loan::count(),
            'pending_approval' => Loan::where('status', 'pending')->count(),
            'total_disbursed' => Loan::where('status', 'active')->sum('amount'),
            'total_repayments' => Repayment::where('status', 'paid')->sum('amount_paid'),
        ];

        $pendingLoans = Loan::with('user', 'loanProduct')->where('status', 'pending')->latest()->get();

        return view('admin.dashboard', compact('stats', 'pendingLoans'));
    }

    public function approveLoan(Loan $loan)
    {
        $loan->update(['status' => 'active']);

        // Generate repayments
        for ($i = 1; $i <= $loan->duration_months; $i++) {
            $loan->repayments()->create([
                'amount_paid' => 0,
                'due_date' => now()->addMonths($i),
                'status' => 'pending',
            ]);
        }

        return back()->with('success', 'Loan approved and repayments scheduled.');
    }

    public function rejectLoan(Loan $loan)
    {
        $loan->update(['status' => 'rejected']);
        return back()->with('success', 'Loan rejected.');
    }
}
