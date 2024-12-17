<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'height',
        'weight',
        'body_type',
        'profile_image',
        'unique_string',
        'status',
    ];



    public function user()
    {
        return $this->hasOne(User::class, 'athlete_profile_id');
    }
}
