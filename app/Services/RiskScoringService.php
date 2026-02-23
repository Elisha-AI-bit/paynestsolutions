<?php

namespace App\Services;

use App\Models\User;

class RiskScoringService
{
    /**
     * Calculate user risk score (0-100)
     * 
     * @param User $user
     * @param float $requestedAmount
     * @return int
     */
    public function calculateScore(User $user, $requestedAmount = 0): int
    {
        $score = 0;

        // 1. Income Weight (25%) - Max 25 points
        // Scale: 25 points for income >= 20,000, linear below
        $incomeScore = min(($user->monthly_income / 20000) * 25, 25);
        $score += $incomeScore;

        // 2. Employment Type Weight (20%) - Max 20 points
        $employmentScores = [
            'government' => 20,
            'marketer' => 15,
            'business' => 10,
        ];
        $score += $employmentScores[$user->employment_type] ?? 5;

        // 3. Loan Amount Ratio Weight (20%) - Max 20 points
        // Relationship between requested amount and monthly income
        if ($requestedAmount > 0 && $user->monthly_income > 0) {
            $ratio = $requestedAmount / ($user->monthly_income * 12); // Annual ratio
            if ($ratio <= 0.1)
                $score += 20;
            elseif ($ratio <= 0.25)
                $score += 15;
            elseif ($ratio <= 0.4)
                $score += 10;
            else
                $score += 5;
        } else {
            $score += 20; // Default buffer
        }

        // 4. Existing Loans Weight (20%) - Max 20 points
        $activeLoansCount = $user->loans()->where('status', 'active')->count();
        if ($activeLoansCount == 0)
            $score += 20;
        elseif ($activeLoansCount == 1)
            $score += 10;
        else
            $score += 0;

        // 5. Repayment History Weight (15%) - Max 15 points
        // Check for overdue repayments across all loans
        $overdueCount = $user->loans()->whereHas('repayments', function ($query) {
            $query->where('status', 'overdue');
        })->count();

        if ($overdueCount == 0) {
            $score += 15;
        } elseif ($overdueCount <= 2) {
            $score += 7;
        } else {
            $score += 0;
        }

        return (int) round($score);
    }
}
