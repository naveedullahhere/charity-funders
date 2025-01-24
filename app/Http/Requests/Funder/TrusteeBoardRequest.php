<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrusteeBoardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'funder_id' => 'nullable|exists:funders,id',
            'trustee' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'status' => 'nullable|in:Up-to-date,Recently,Registered',
        ];
    }

    public function messages()
    {
        return [
            'funder_id.exists' => 'The selected funder is invalid.',
            'trustee.string' => 'The trustee must be a string.',
            'trustee.max' => 'The trustee may not be greater than 255 characters.',
            'position.string' => 'The position must be a string.',
            'position.max' => 'The position may not be greater than 255 characters.',
            'status.in' => 'The status must be one of: Up-to-date, Recently, Registered.',
        ];
    }
}