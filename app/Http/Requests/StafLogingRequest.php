<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StafLogingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stafId' => ['required' , 'exists:stafs,id'],
            'enterTime' => ['nullable' , 'date_format:H:i'],
            'exitTime' => ['nullable' , 'date_format:H:i']
        ];
    }
}
