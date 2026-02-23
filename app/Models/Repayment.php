<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    protected $fillable = [
        'loan_id',
        'amount_paid',
        'due_date',
        'status',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
        ];
    }
}
