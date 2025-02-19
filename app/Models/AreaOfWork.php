<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaOfWork extends Model
{
    protected $fillable = [
        'funder_id',
        'work_area_id',
    ];

    protected $table = "areas_of_work";

    // Relationship: Funder
    public function funder()
    {
        return $this->belongsTo(Funder::class, 'funder_id');
    }

    // Relationship: Work Area
    public function workArea()
    {
        return $this->belongsTo(WorkArea::class, 'work_area_id');
    }

    
}
