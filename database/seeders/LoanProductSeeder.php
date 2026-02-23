<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\LoanProduct::insert([
            [
                'name' => 'Government Loan',
                'interest_min' => 5.00,
                'interest_max' => 8.00,
                'max_amount' => 500000.00,
                'min_duration' => 6,
                'max_duration' => 60,
                'employment_type_required' => 'government',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marketer Loan',
                'interest_min' => 10.00,
                'interest_max' => 15.00,
                'max_amount' => 100000.00,
                'min_duration' => 3,
                'max_duration' => 24,
                'employment_type_required' => 'marketer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business Loan',
                'interest_min' => 12.00,
                'interest_max' => 20.00,
                'max_amount' => 1000000.00,
                'min_duration' => 6,
                'max_duration' => 48,
                'employment_type_required' => 'business',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
