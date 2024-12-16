<?php
namespace App\Http\Services\SubscriptionCoachManagement\EditeSubscriptionCoach\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeSubscriptionCoachInput implements InputServiceInterface
{
    private int $subscriptionCoachId;
    public int $subscriptionId;
    public int $coachId;
    public string $fromHouer;
    public string $toHouer;
    public string $period;

    public function __construct( array $input)
    {
        $this->subscriptionCoachId = $input['subscriptionCoachId'];
        $this->subscriptionId = $input['subscriptionId'];
        $this->coachId = $input['coachId'];
        $this->fromHouer = $input['fromHouer'];
        $this->toHouer = $input['toHouer'];
        $this->period = $input['period'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'subscriptionId' => $this->subscriptionId,
            'coachId' => $this->coachId,
            'fromHouer' => $this->fromHouer,
            'toHouer' => $this->toHouer,
            'period' => $this->period
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
