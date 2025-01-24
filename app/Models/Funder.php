<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name',
        'charity_no',
        'p_name',
        'web',
        'phone',
        'email',
        'address_line1',
        'address_line2',
        'region',
        'city',
        'postcode',
        'country_id',
        'location',
        'lat',
        'lng',
        'company_description',
        'contact_person_name',
        'contact_person_designation',
        'contact_person_phone',
        'contact_person_email',
        'previous_grant_beneficiaries',
        'trustee_board_man_power',
        'operation',
        'facebook',
        'twitter',
        'google_plus',
        'charity_url',
        'status',
        'logo',
        'slug',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // Relationship: Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relationship: Sub Category
    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    // Relationship: Country
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function financialDetails()
    {
        return $this->hasMany(FinancialDetail::class, 'funder_id');
    }
    public function trusteeBoards()
    {
        return $this->hasMany(TrusteeBoard::class, 'funder_id');
    }
     public function areasOfWork()
    {
        return $this->hasMany(AreaOfWork::class, 'funder_id');
    }
      // Relationship: Donation Applications
    public function donationApplications()
    {
        return $this->hasMany(DonationApplication::class, 'funder_id');
    }
}