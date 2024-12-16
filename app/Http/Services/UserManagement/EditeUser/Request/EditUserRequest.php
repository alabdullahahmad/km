<?php
namespace App\Http\Services\UserManagement\EditeUser\Request;

use App\Http\Core\Const\Options\GendorOptions;
use App\Http\Core\Request\BaseRequest;

class EditUserRequest extends BaseRequest
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
            'userId' => ['required' , 'string', 'exists:users,id'],
            'name'=>['nullable' ,"string","min:3","max:20"],
            'familyNumber'=>['nullable' , 'string', 'min:10','max:10'  ],
            'homeNumber'=>['nullable' , 'string'   ],
            'address' => ['nullable','string', 'min:3' , 'max:50'],
            'personalid' => ['nullable' , 'string' , 'min:11','max:11'],
            'gender' => ['nullable' , 'string' ],
            'birthDay' => ['nullable' , 'date' , 'date_format:Y-m-d'],
            // 'password'=>['nullable' ,"string","min:8"],
            'qr'=>['nullable' ,"string"],
        ];
    }

}
