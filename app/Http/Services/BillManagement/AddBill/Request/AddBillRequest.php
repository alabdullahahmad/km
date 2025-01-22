<?php
namespace App\Http\Services\BillManagement\AddBill\Request;

use App\Http\Core\Const\Options\PayTypeOptions;
use App\Http\Core\Request\BaseRequest;
use Illuminate\Validation\Rule;

class AddBillRequest extends BaseRequest
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
            // 'branchId' => ['required', 'integer' , 'exists:branches,id'],
            'payType' => ['nullable' , 'string' , Rule::in(PayTypeOptions::getAll())],
            'date' => ['nullable' ,'date','date_format:Y-m-d' ],
            'amount' => ['required' , 'integer' , 'min:0'],
            'description' => ['required' , 'string', 'min:3' , 'max:150'],
            'discountAmount' => ['nullable' , 'integer', 'min:0'],
            'discountBecouse' => ['nullable' , 'string'],
            'startDate' => ['nullable' , 'date_format:Y-m-d'],
            'paymrentNote' => ['nullable' , 'string'],
            'coachId' => ['nullable' , 'integer' , 'exists:coaches,id'],
            'subscriptionId' => ['nullable' , 'integer' , 'exists:subscriptions,id'],
            'subscriptionCoachId' => ['nullable' , 'integer' , 'exists:subscription_coaches,id'],
            'userId' => ['nullable' , 'integer' , 'exists:users,id'],
            'numOfDays' => ['nullable' , 'integer'],
            'price' => ['nullable' , 'integer']
        ];
    }

}
