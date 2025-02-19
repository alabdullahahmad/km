<?php
namespace App\Http\Services\BranchManagement\EditeBranch\Request;

use App\Http\Core\Request\BaseRequest;

class EditeBranchRequest extends BaseRequest
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
            'branchId' => ['required', 'integer' , 'exists:branches,id'],
            'name'=>['required' ,"string","min:3","max:20"],
            'address' => ['required','string', 'min:3' , 'max:50'],
            'city' => ['required','string', 'min:3' , 'max:50'],
        ];
    }

}
