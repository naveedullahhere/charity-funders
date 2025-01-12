<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    use HasFactory;

    protected $fillable = ['basket_id', 'item_id', 'item_type', 'price', 'quantity', 'quality'];

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'item_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'item_id');
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'item_id');
    }
}
