<?php
namespace App\Http\Services\CompletePaymenet\Request;

use App\Http\Core\Request\BaseRequest;

class CompletePaymenetRequest extends BaseRequest
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
            'billId'=>['required', 'integer' , 'exists:bills,id'],
            'amount'=>['required','integer','min:0'],
            'description' => ['nullable' , 'string']
        ];
    }

}
