<?php
namespace App\Http\Services\SubscriptionManagement\ShowSubscription\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowSubscriptionInput implements InputServiceInterface
{
    private int $subscriptionId;
    public function __construct( array $input)
    {
        $this->subscriptionId = $input['subscriptionId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    /**
     * Get the value of subscriptionId
     */
    public function getSubscriptionId()
    {
        return $this->subscriptionId;
    }

    /**
     * Set the value of subscriptionId
     *
     * @return  self
     */
    public function setSubscriptionId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;

        return $this;
    }
}
