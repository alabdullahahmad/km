<?php
namespace App\Http\Services\BillManagement\EditeBill\Request;

use App\Http\Core\Const\Options\PayTypeOptions;
use App\Http\Core\Request\BaseRequest;
use Illuminate\Validation\Rule;

class EditeBillRequest extends BaseRequest
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
            'payType' => ['required' , 'string' , Rule::in(PayTypeOptions::getAll())],
            'amount' => ['required' , 'integer'],
            'description' => ['required' , 'string', 'min:3' , 'max:150'],
        ];
    }

}
