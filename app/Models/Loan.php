<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'loan_product_id',
        'amount',
        'interest_rate',
        'duration_months',
        'monthly_payment',
        'total_payable',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanProduct()
    {
        return $this->belongsTo(LoanProduct::class);
    }

    public function repayments()
    {
        return $this->hasMany(Repayment::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
