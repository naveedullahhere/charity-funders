<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_name',
        'slug',
        'status',
        'created_by',
    ];


    protected static function boot()
    {
        parent::boot();

        // Listen for the creating event to generate slug before saving
        static::creating(function ($model) {
            $slug = Str::slug($model->collection_name);

            // Check if the generated slug already exists
            $count = static::where('slug', $slug)->count();
            if ($count > 0) {
                // Append a number to make the slug unique
                $slug .= '-' . ($count + 1);
            }

            $model->slug = $slug;
        });

        // Listen for the updating event to update slug if collection_name is changed
        static::updating(function ($model) {
            // Check if the collection_name attribute is being updated
            if ($model->isDirty('collection_name')) {
                $slug = Str::slug($model->collection_name);

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

    public function mediaMappings()
    {
        return $this->belongsToMany(Media::class, 'collection_media_mapping', 'collection_id', 'media_id');
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'collection_media_mapping', 'collection_id', 'media_id');
    }

 

    // public function mediaMappings()
    // {
    //     return $this->belongsToMany(Media::class, 'collection_media_mapping', 'collection_id', 'media_id')
    //         ->withPivot('event_id', 'group_id')
    //         ->withTimestamps();
    // }
    // public function event()
    // {
    //     return $this->hasOneThrough(
    //         Event::class,  // Related model you want to access
    //         CollectionMediaMapping::class,  // Intermediate model/pivot table
    //         'media_id',  // Foreign key on the intermediate table
    //         'id',        // Foreign key on the related table (events)
    //         'id',        // Local key on this model (media)
    //         'event_id'   // Local key on the intermediate table (collection_media_mapping)
    //     );
    // }


    // public function event()
    // {
    //     return $this->hasManyThrough(
    //         Event::class,                          // The Event model (destination table)
    //         CollectionMediaMapping::class,          // The pivot/intermediate table
    //         'collection_id',                       // Foreign key on pivot (linking to collections)
    //         'id',                                  // Primary key on events
    //         'id',                                  // Primary key on collections
    //         'event_id'                             // Foreign key on pivot (linking to events)
    //     );
    // }
    public function totalPrice()
    {
        // Count videos and images through mediaMappings
        $videoCount = $this->mediaMappings()->get();
        // ->join('media as m_video', 'collection_media_mapping.media_id', '=', 'm_video.id')
        // ->where('m_video.file_type', 'video')
        // ->count();

        $imageCount = $this->mediaMappings();
        // ->join('media as m_image', 'collection_media_mapping.media_id', '=', 'm_image.id')
        // ->where('m_image.file_type', 'image')
        // ->count();

        // Calculate total price
        return  $imageCount;
        return ($videoCount * $this->price_per_video) + ($imageCount * $this->price_per_image);
    }
}
