<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'note_details',
        'status',
        'lead_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    protected $guarded = [];

    public function interactions()
    {
        return $this->morphMany(Interactions::class, 'interactable');
    }



    /**
     * Define the relationship with the User model for the creator.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Define the relationship with the User model for the updater.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Define the relationship with the User model for the deleter.
     */
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /**
     * Define the relationship with the Lead model.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
