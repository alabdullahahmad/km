<?php
namespace App\Http\Services\SubscriptionManagement\EditeSubscription\Request;

use App\Http\Core\Request\BaseRequest;

class EditSubscriptionRequest extends BaseRequest
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
            'subscriptionId' => ['required' , 'integer' , 'exists:subscriptions,id'],
            'name' => ['required' , 'string'],
            'price' => ['required' , 'integer'],
            'numOfDays' => ['required' , 'integer'],
            'numOfSessions' => ['required' , 'integer'],
            'description' => ['nullable' , 'string'],
        ];
    }

}
