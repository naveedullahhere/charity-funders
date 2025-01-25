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
        'application_procedure',
        'p_name',
        'web',
        'phone',
        'email',
        'address_line1',
        'address_line2',
        'type_id',
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
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
        return $this->belongsToMany(WorkArea::class, 'areas_of_work', 'funder_id', 'work_area_id');
    }

    public function workAreas()
    {
        return $this->belongsToMany(WorkArea::class, 'areas_of_work', 'funder_id', 'work_area_id');
    }

    public function donationApplications()
    {
        return $this->hasMany(DonationApplication::class, 'funder_id');
    }
}
