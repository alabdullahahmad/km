<?php
namespace App\Http\Services\PlayerLoginLogManagement\AddPlayerLoginLog\Request;

use App\Http\Core\Request\BaseRequest;

class AddPlayerLoginLogRequest extends BaseRequest
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
            'user_id' => ['required' , 'integer','exists:users,id'],
            'subscription_name' => ['required' , 'string' ],
            'billId' => ['required' , 'integer' , 'exists:bills,id'],
        ];
    }

}
