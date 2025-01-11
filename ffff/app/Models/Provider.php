<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'phone',
        'email',
        'password',
        'logo',
        'address',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'integer', // Cast status field to integer
    ];
}
