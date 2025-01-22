<?php
namespace App\Http\Services\EditUserBill\Request;

use Illuminate\Validation\Rule;
use App\Http\Core\Request\BaseRequest;
use App\Http\Core\Const\Options\PayTypeOptions;

class EditUserBillRequest extends BaseRequest
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
            'billId' => ['required', 'integer' , 'exists:bills,id'],
            'subscriptionId' => ['required' , 'integer' , 'exists:subscriptions,id'],
            'coachId' => ['nullable' , 'integer' , 'exists:coaches,id'],
            'subscriptionCoachId' => ['nullable' , 'integer' , 'exists:subscription_coaches,id'],
            'price' => ['required' , 'integer']
        ];
    }

}
