<?php

namespace App\Http\Requests\Funder;

use Illuminate\Foundation\Http\FormRequest;

class AreaOfWorkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'funder_id' => 'nullable|exists:funders,id',
            'work_area_id' => 'nullable|exists:work_areas,id',
        ];
    }

    public function messages()
    {
        return [
            'funder_id.exists' => 'The selected funder is invalid.',
            'work_area_id.exists' => 'The selected work area is invalid.',
        ];
    }
}