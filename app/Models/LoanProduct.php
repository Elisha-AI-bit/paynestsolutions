<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model
{
    protected $fillable = [
        'name',
        'interest_min',
        'interest_max',
        'max_amount',
        'min_duration',
        'max_duration',
        'employment_type_required',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
