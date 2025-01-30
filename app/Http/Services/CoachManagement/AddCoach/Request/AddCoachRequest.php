<?php
namespace App\Http\Services\CoachManagement\AddCoach\Request;

use App\Http\Core\Const\Options\GendorOptions;
use App\Http\Core\Request\BaseRequest;

class AddCoachRequest extends BaseRequest
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
            'name'=>['required' ,"string","min:3","max:20"],
            'photo'=>['nullable', 'image' , 'mimes:png,jpg'],
            'address' => ['nullable','string', 'min:3' , 'max:50'],
            // 'personalid' => ['nullable' , 'string' , 'min:11','max:11'],
            'gender' => ['required' , 'string' ],
            'birthDay' => ['nullable' , 'date' , 'date_format:Y-m-d'],
            'percentage' => ['required' , 'integer' , 'min:0' , 'max:100'],
            // 'password'=>['required' ,"string","min:8"],
            'class.*' => ['required' , 'integer'],
            'branchId' => ['required' , 'integer' , 'exists:branches,id'],

        ];
    }

}
