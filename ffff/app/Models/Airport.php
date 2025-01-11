<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Airport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'header_image',
        'description',
        'status',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'created_by',
        'deleted_by',
    ];

    protected static function boot()
    {
        parent::boot();

        // Listen for the creating event to generate slug before saving
        static::creating(function ($model) {
            $slug = Str::slug($model->title);

            // Check if the generated slug already exists
            $count = static::where('slug', $slug)->count();
            if ($count > 0) {
                // Append a number to make the slug unique
                $slug .= '-' . ($count + 1);
            }

            $model->slug = $slug;
        });

        // Listen for the updating event to update slug if title is changed
        static::updating(function ($model) {
            // Check if the title attribute is being updated
            if ($model->isDirty('title')) {
                $slug = Str::slug($model->title);

                // Check if the generated slug already exists
                $count = static::where('slug', $slug)->where('id', '!=', $model->id)->count();
                if ($count > 0) {
                    // Append a number to make the slug unique
                    $slug .= '-' . ($count + 1);
                }

                $model->slug = $slug;
            }
        });
    }


// Define relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
