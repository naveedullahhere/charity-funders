<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationApplication extends Model
{
    protected $fillable = [
        'funder_id',
        'year',
        'received',
        'successful',
        'rate',
    ];

    // Relationship: Funder
    public function funder()
    {
        return $this->belongsTo(Funder::class, 'funder_id');
    }
}