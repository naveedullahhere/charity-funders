<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CollectionMediaMapping extends Model
{
    use HasFactory;

    protected $table = "collection_media_mapping";

    protected $fillable = [
        'id',
        'collection_id',
        'event_id',
        'group_id',
        'media_id',
        'file_type'
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
