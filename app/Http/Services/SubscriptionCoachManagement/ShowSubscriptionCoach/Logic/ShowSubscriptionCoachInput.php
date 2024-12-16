<?php
namespace App\Http\Services\SubscriptionCoachManagement\ShowSubscriptionCoach\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowSubscriptionCoachInput implements InputServiceInterface
{
    private int $subscriptionCoachId;
    public function __construct( array $input)
    {
        $this->subscriptionCoachId = $input['subscriptionCoachId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    /**
     * Get the value of subscriptionCoachId
     */
    public function getSubscriptionCoachId()
    {
        return $this->subscriptionCoachId;
    }

    /**
     * Set the value of subscriptionCoachId
     *
     * @return  self
     */
    public function setSubscriptionCoachId($subscriptionCoachId)
    {
        $this->subscriptionCoachId = $subscriptionCoachId;

        return $this;
    }
}
