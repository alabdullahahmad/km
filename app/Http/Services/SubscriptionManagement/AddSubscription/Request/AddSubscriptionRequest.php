<?php
namespace App\Http\Services\SubscriptionManagement\AddSubscription\Request;

use App\Http\Core\Request\BaseRequest;

class AddSubscriptionRequest extends BaseRequest
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
            'name' => ['required' , 'string'],
            'tagId' => ['required' , 'integer' , 'exists:tags,id'],
            'price' => ['required' , 'integer'],
            'numOfDays' => ['required' , 'integer'],
            'numOfSessions' => ['required' , 'integer'],
            'description' => ['nullable' , 'string'],
            'categoryId' => ['required', 'integer' , 'exists:categories,id'],
            'branchId' => ['required' , 'integer' , 'exists:branches,id'],

        ];
    }

}
