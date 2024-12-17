<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'event_id',
        'status',
        'created_by',
        'deleted_by',
    ];

    /**
     * Relationship with the Media model
     */
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    /**
     * Relationship with the User model for created_by
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship with the User model for deleted_by
     */
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /**
     * Relationship with the Event model
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function getGroupedMediaAttribute()
    {
        return $this->media->groupBy('group_id');
    }
    public function getUniqueFileCount($fileType)
    {
        // Validate file type
        if (!in_array($fileType, ['image', 'video'])) {
            throw new \InvalidArgumentException('Invalid file type. Must be "image" or "video".');
        }

        // Get media items filtered by file type
        $mediaItems = $this->media()->where('file_type', $fileType)->get();
// dd($mediaItems);
        // Group by image_id (or video_id) to ensure unique counts
        $uniqueFiles = $mediaItems->groupBy('group_id')->count(); // Adjust 'file_id' if necessary

        return $uniqueFiles;
    }
}