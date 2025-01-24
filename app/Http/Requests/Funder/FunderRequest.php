<?php

namespace App\Http\Requests\Funder;

use Illuminate\Foundation\Http\FormRequest;

class FunderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'sub_category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'charity_no' => 'nullable|string|max:50',
            'p_name' => 'nullable|string|max:255',
            'web' => 'nullable|url|max:100',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:20',
            'country_id' => 'nullable|exists:countries,id',
            'location' => 'nullable|string|max:255',
            'lat' => 'nullable|string|max:100',
            'lng' => 'nullable|string|max:100',
            'company_description' => 'nullable|string',
            'contact_person_name' => 'nullable|string|max:100',
            'contact_person_designation' => 'nullable|string|max:100',
            'contact_person_phone' => 'nullable|string|max:30',
            'contact_person_email' => 'nullable|email|max:100',
            'previous_grant_beneficiaries' => 'nullable|numeric',
            'trustee_board_man_power' => 'nullable|string|max:255',
            'operation' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:100',
            'twitter' => 'nullable|url|max:100',
            'google_plus' => 'nullable|url|max:255',
            'charity_url' => 'nullable|url|max:255',
            'status' => 'required|in:Publish,Draft',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Logo validation
        ];
    }

    public function messages()
    {
        return [
            'category_id.exists' => 'The selected category is invalid.',
            'sub_category_id.exists' => 'The selected sub category is invalid.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'charity_no.string' => 'The charity number must be a string.',
            'charity_no.max' => 'The charity number may not be greater than 50 characters.',
            'p_name.string' => 'The person name must be a string.',
            'p_name.max' => 'The person name may not be greater than 255 characters.',
            'web.url' => 'The website must be a valid URL.',
            'web.max' => 'The website may not be greater than 100 characters.',
            'phone.string' => 'The phone number must be a string.',
            'phone.max' => 'The phone number may not be greater than 30 characters.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'address_line1.string' => 'The address line 1 must be a string.',
            'address_line1.max' => 'The address line 1 may not be greater than 255 characters.',
            'address_line2.string' => 'The address line 2 must be a string.',
            'address_line2.max' => 'The address line 2 may not be greater than 255 characters.',
            'region.string' => 'The region must be a string.',
            'region.max' => 'The region may not be greater than 100 characters.',
            'city.string' => 'The city must be a string.',
            'city.max' => 'The city may not be greater than 100 characters.',
            'postcode.string' => 'The postcode must be a string.',
            'postcode.max' => 'The postcode may not be greater than 20 characters.',
            'country_id.exists' => 'The selected country is invalid.',
            'location.string' => 'The location must be a string.',
            'location.max' => 'The location may not be greater than 255 characters.',
            'lat.string' => 'The latitude must be a string.',
            'lat.max' => 'The latitude may not be greater than 100 characters.',
            'lng.string' => 'The longitude must be a string.',
            'lng.max' => 'The longitude may not be greater than 100 characters.',
            'company_description.string' => 'The company description must be a string.',
            'contact_person_name.string' => 'The contact person name must be a string.',
            'contact_person_name.max' => 'The contact person name may not be greater than 100 characters.',
            'contact_person_designation.string' => 'The contact person designation must be a string.',
            'contact_person_designation.max' => 'The contact person designation may not be greater than 100 characters.',
            'contact_person_phone.string' => 'The contact person phone must be a string.',
            'contact_person_phone.max' => 'The contact person phone may not be greater than 30 characters.',
            'contact_person_email.email' => 'The contact person email must be a valid email address.',
            'contact_person_email.max' => 'The contact person email may not be greater than 100 characters.',
            'previous_grant_beneficiaries.numeric' => 'The previous grant beneficiaries must be a number.',
            'trustee_board_man_power.string' => 'The trustee board manpower must be a string.',
            'trustee_board_man_power.max' => 'The trustee board manpower may not be greater than 255 characters.',
            'operation.string' => 'The operation must be a string.',
            'operation.max' => 'The operation may not be greater than 255 characters.',
            'facebook.url' => 'The Facebook URL must be a valid URL.',
            'facebook.max' => 'The Facebook URL may not be greater than 100 characters.',
            'twitter.url' => 'The Twitter URL must be a valid URL.',
            'twitter.max' => 'The Twitter URL may not be greater than 100 characters.',
            'google_plus.url' => 'The Google Plus URL must be a valid URL.',
            'google_plus.max' => 'The Google Plus URL may not be greater than 255 characters.',
            'charity_url.url' => 'The charity URL must be a valid URL.',
            'charity_url.max' => 'The charity URL may not be greater than 255 characters.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either "Publish" or "Draft".',
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif.',
            'logo.max' => 'The logo may not be greater than 2048 kilobytes.',
        ];
    }
}