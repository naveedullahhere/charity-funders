<?php

namespace App\Http\Requests\Funder;

use Illuminate\Foundation\Http\FormRequest;

class FinancialDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'funder_id' => 'nullable|exists:funders,id',
            'year' => 'nullable|string|max:10',
            'income' => 'nullable|string|max:30',
            'spend' => 'nullable|string|max:30',
        ];
    }

    public function messages()
    {
        return [
            'funder_id.exists' => 'The selected funder is invalid.',
            'year.string' => 'The year must be a string.',
            'year.max' => 'The year may not be greater than 10 characters.',
            'income.string' => 'The income must be a string.',
            'income.max' => 'The income may not be greater than 30 characters.',
            'spend.string' => 'The spend must be a string.',
            'spend.max' => 'The spend may not be greater than 30 characters.',
        ];
    }
}