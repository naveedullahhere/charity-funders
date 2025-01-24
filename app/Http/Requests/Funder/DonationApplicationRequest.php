<?php

namespace App\Http\Requests\Funder;

use Illuminate\Foundation\Http\FormRequest;

class DonationApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'funder_id' => 'nullable|exists:funders,id',
            'year' => 'nullable|integer',
            'received' => 'nullable|integer',
            'successful' => 'nullable|integer',
            'rate' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'funder_id.exists' => 'The selected funder is invalid.',
            'year.integer' => 'The year must be an integer.',
            'received.integer' => 'The received applications must be an integer.',
            'successful.integer' => 'The successful applications must be an integer.',
            'rate.numeric' => 'The success rate must be a number.',
        ];
    }
}