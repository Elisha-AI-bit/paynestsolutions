<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Account
        User::factory()->create([
            'name' => 'Admin PayNest',
            'email' => 'admin@paynest.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin',
            'nrc' => '111111/11/1',
            'phone' => '0970000000',
            'employment_type' => 'government',
            'monthly_income' => 50000,
            'risk_score' => 100,
        ]);

        // Test User 1
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'user',
            'nrc' => '222222/22/2',
            'phone' => '0971111111',
            'employment_type' => 'government',
            'monthly_income' => 12000,
            'risk_score' => 85,
        ]);

        // Test User 2
        User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'user',
            'nrc' => '333333/33/3',
            'phone' => '0972222222',
            'employment_type' => 'marketer',
            'monthly_income' => 4500,
            'risk_score' => 45,
        ]);

        $this->call([
            LoanProductSeeder::class,
        ]);
    }
}
