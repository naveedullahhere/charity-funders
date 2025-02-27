<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrusteeBoard extends Model
{
    protected $fillable = [
        'funder_id',
        'trustee',
        'position',
        'status',
    ];

    protected $table = 'trustee_board';

    // Relationship: Funder
    public function funder()
    {
        return $this->belongsTo(Funder::class, 'funder_id');
    }
}
