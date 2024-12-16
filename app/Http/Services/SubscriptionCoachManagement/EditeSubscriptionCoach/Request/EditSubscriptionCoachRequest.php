<?php
namespace App\Http\services\SubscriptionCoachManagement\EditeSubscriptionCoach\Request;

use App\Http\Core\Request\BaseRequest;

class EditSubscriptionCoachRequest extends BaseRequest
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
            'subscriptionCoachId' => ['required' , 'integer' , 'exists:subscription_coaches,id'],
            'subscriptionId' => ['required' , 'integer' , 'exists:subscriptions,id'],
            'coachId' => ['required' , 'integer' , 'exists:coaches,id'],
            'fromHouer' => ['required' , 'string'],
            'toHouer'   => ['required' , 'string'],
            'period' => ['required' , 'string'],
        ];
    }

}
