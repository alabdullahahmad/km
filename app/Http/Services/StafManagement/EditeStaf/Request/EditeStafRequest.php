<?php
namespace App\Http\Services\StafManagement\EditeStaf\Request;

use App\Http\Core\Const\Options\GendorOptions;
use App\Http\Core\Request\BaseRequest;

class EditeStafRequest extends BaseRequest
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
            'stafId' => ['required', 'integer' , 'exists:stafs,id'],
            'name'=>['required' ,"string","min:3","max:20"],
            'address' => ['nullable','string', 'min:3' , 'max:50'],
            'personalid' => ['nullable' , 'string' , 'min:11','max:11'],
            'gender' => ['required' , 'string' ],
            'birthDay' => ['nullable' , 'date' , 'date_format:Y-m-d'],
            'password'=>['nullable' ,"string","min:8"],
            'phoneNumber'=>['nullable' , 'string', 'min:10','max:10'],
            'branchId' => ['required' , 'integer' , 'exists:branches,id'],
            'roleId' => ['required' , 'integer' , 'exists:roles,id'],
            // 'isAdmin' => ['required' , 'boolean']
        ];
    }

}
