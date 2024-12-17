<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'provider_id',
        'airport_id',
        'space_id',
        'phone',
        'transfer_required',
        'selling_points',
        'min_lead_time',
        'max_lead_time',
        'address',
        'post_code',
        'city',
        'satnav',
        'short_description',
        'long_description',
        'arrival_procedure',
        'return_procedure',
        'additional_info',
        'instruction_content',
        'page_content',
        'product_priority',
        'total_space',
        'price',
        'status',
    ];


    public static function validateData(array $data)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'provider_id' => 'nullable|integer',
            'airport_id' => 'nullable|integer',
            'space_id' => 'nullable|integer',
            'phone' => 'nullable|string|max:100',
            'transfer_required' => 'nullable',
            'selling_points' => 'nullable|string',
            'min_lead_time' => 'nullable|integer',
            'max_lead_time' => 'nullable|integer',
            'address' => 'nullable|string|max:500',
            'post_code' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'satnav' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'arrival_procedure' => 'nullable|string',
            'return_procedure' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'instruction_content' => 'nullable|string',
            'page_content' => 'nullable|string',
            'product_priority' => 'nullable|integer',
            'total_space' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'status' => 'nullable',
        ];

        return Validator::make($data, $rules);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function airport()
    {
        return $this->belongsTo(Airport::class);
    }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
