<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        "order_no",
        "email",
        "first_name",
        "last_name",
        "phone_no",
        "address",
        "city",
        "state",
        "zip",
        "product_price",
        "basket_id",
        "product_price",
        "payment_method",
        "payment_status",
        "status",
        "transaction_key",
        "transaction_url",
        "user_id",
        "inv_id",

    ];


}
