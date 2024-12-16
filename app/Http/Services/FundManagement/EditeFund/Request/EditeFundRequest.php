<?php
namespace App\Http\Services\FundManagement\AddFund\Request;

use App\Http\Core\Request\BaseRequest;

class EditeFundRequest extends BaseRequest
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
            'fundId' => ['required', 'integer' , 'exists:funds,id'],
            'branchId'=>['nullable', 'integer' , 'exists:branches,id'],
            'amount'=>['required' ,"integer"],
        ];
    }

}
