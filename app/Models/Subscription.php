<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'jobTitle',
        'organisationName',
        'charityNo',
        'address',
        'townOrcity',
        'postCode',
        'emailAddress',
        'telephoneNumber',
        'password',
        'newsletter',
        'terms',
        'subscriptionType',
        'subscriptionAmount',
        'paymentMethod',
    ];
}
