<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialDetail extends Model
{
    protected $fillable = [
        'funder_id',
        'year',
        'income',
        'spend',
    ];

    // Relationship: Funder
    public function funder()
    {
        return $this->belongsTo(Funder::class, 'funder_id');
    }
}