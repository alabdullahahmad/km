<?php
namespace App\Http\Services\StafManagement\AddStaf\Request;

use App\Http\Core\Const\Options\GendorOptions;
use App\Http\Core\Request\BaseRequest;

class AddStafRequest extends BaseRequest
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
            'phoneNumber'=>['required' , 'string', 'min:10','max:10' , 'unique:stafs,phoneNumber'  ],
            'address' => ['nullable','string', 'min:3' , 'max:50'],
            'personalid' => ['nullable' , 'string' , 'min:11','max:11'],
            'gender' => ['required' , 'string' ],
            'birthDay' => ['nullable' , 'date' , 'date_format:Y-m-d'],
            'password'=>['required' ,"string","min:8"],
            'isAdmin' => ['nullable' , 'boolean'],
            'branchId' => ['required' , 'integer' , 'exists:branches,id'],
        ];
    }

}
