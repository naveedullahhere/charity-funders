<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'gallery_id',
        'file_path',
        'file_type',
        'resolution',
        'resolution_type',
        'size',
        'is_thumbnail',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'collection_media_mapping', 'media_id', 'collection_id')
            ->withPivot('event_id', 'group_id')
            ->withTimestamps();
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
