<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'name',
        'slug',
        'event_location_id',
        'event_role_id',
        'event_date',
        'thumbnail',
        'whole_high_event_price',
        'price_per_high_video',
        'price_per_high_image',
        'whole_event_price',
        'price_per_video',
        'price_per_image',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'created_by',
        'deleted_by',
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['event_date', 'deleted_at'];

    /**
     * Get the user who created the event.
     */



    protected static function boot()
    {
        parent::boot();

        // Listen for the creating event to generate slug before saving
        static::creating(function ($model) {
            $slug = Str::slug($model->name);

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
            if ($model->isDirty('name')) {
                $slug = Str::slug($model->name);

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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who deleted the event.
     */
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /**
     * Get the location associated with the event.
     */
    public function event_location()
    {
        return $this->belongsTo(EventLocation::class, 'event_location_id');
    }

    /**
     * Get the role associated with the event.
     */
    public function event_role()
    {
        return $this->belongsTo(EventRole::class, 'event_role_id');
    }

    /**
     * Relationship with the Gallery model
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'event_id');
    }
}
