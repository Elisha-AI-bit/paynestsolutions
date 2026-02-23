<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = LoanProduct::where('employment_type_required', $user->employment_type)->get();
        $loans = $user->loans()->with('loanProduct')->latest()->get();
        $maxEligible = $user->monthly_income * 10;

        return view('dashboard', compact('products', 'loans', 'maxEligible'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'product_id' => 'required|exists:loan_products,id',
        ]);

        $product = LoanProduct::findOrFail($request->product_id);
        $user = Auth::user();

        // Logic check: Max amount based on income multiplier
        $maxEligible = $user->monthly_income * 10;
        if ($request->amount > $maxEligible) {
            return response()->json(['error' => 'Amount exceeds your eligibility limit based on income.'], 422);
        }

        if ($request->amount > $product->max_amount) {
            return response()->json(['error' => 'Amount exceeds product maximum limit.'], 422);
        }

        // Risk-based interest selection
        $interestRate = $product->interest_max;
        if ($user->risk_score > 80) {
            $interestRate = $product->interest_min;
        } elseif ($user->risk_score >= 50) {
            $interestRate = ($product->interest_min + $product->interest_max) / 2;
        }

        $totalInterest = $request->amount * ($interestRate / 100);
        $totalPayable = $request->amount + $totalInterest;
        $monthlyPayment = $totalPayable / $request->duration;

        return response()->json([
            'interest_rate' => $interestRate,
            'monthly_payment' => round($monthlyPayment, 2),
            'total_payable' => round($totalPayable, 2),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'duration_months' => 'required|integer|min:1',
            'loan_product_id' => 'required|exists:loan_products,id',
        ]);

        $product = LoanProduct::findOrFail($request->loan_product_id);
        $user = Auth::user();

        // Recalculate server-side for security
        $interestRate = $product->interest_max;
        if ($user->risk_score > 80) {
            $interestRate = $product->interest_min;
        } elseif ($user->risk_score >= 50) {
            $interestRate = ($product->interest_min + $product->interest_max) / 2;
        }

        $totalInterest = $request->amount * ($interestRate / 100);
        $totalPayable = $request->amount + $totalInterest;
        $monthlyPayment = $totalPayable / $request->duration_months;

        $loan = Loan::create([
            'user_id' => $user->id,
            'loan_product_id' => $product->id,
            'amount' => $request->amount,
            'interest_rate' => $interestRate,
            'duration_months' => $request->duration_months,
            'monthly_payment' => $monthlyPayment,
            'total_payable' => $totalPayable,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Loan application submitted successfully.');
    }
}
