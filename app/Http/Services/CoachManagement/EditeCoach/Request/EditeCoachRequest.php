<?php
namespace App\Http\Services\CoachManagement\EditeCoach\Request;

use App\Http\Core\Request\BaseRequest;
use App\Http\Core\Const\Options\GendorOptions;

class EditeCoachRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return
        [
            'coacheId' => ['required' , 'integer' , 'exists:coaches,id'],
            'name'=>['required' ,"string","min:3","max:20"],
            'photo'=>['nullable', 'image' , 'mimes:png,jpg'],
            'phoneNumber'=>['required' , 'string', 'min:10','max:10'  ],
            'address' => ['nullable','string', 'min:3' , 'max:50'],
            // 'personalid' => ['nullable' , 'string' , 'min:11','max:11'],
            'gender' => ['required' , 'string' , ],
            'birthDay' => ['nullable' , 'date' , 'date_format:Y-m-d'],
            'percentage' => ['required' , 'integer' , 'min:0' , 'max:100'],
            'branchId' => ['required' , 'integer' , 'exists:branches,id'],
        ];
    }

}
