<?php
namespace App\Http\Services\SubscriptionCoachManagement\AddSubscriptionCoach\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddSubscriptionCoachInput implements InputServiceInterface
{
    public int $subscriptionId;
    public int $coachId;
    public int $roomId;
    public string $fromHouer;
    public string $toHouer;
    public string $period;
    public int $dayOfWeek;

    public function __construct( array $input)
    {
        $this->subscriptionId = $input['subscriptionId'];
        $this->coachId = $input['coachId'];
        $this->roomId = $input['roomId'];
        $this->fromHouer = $input['fromHouer'];
        $this->toHouer = $input['toHouer'];
        $this->period = $input['period'];
        $this->dayOfWeek = $input['dayOfWeek'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'subscriptionId' => $this->subscriptionId,
            'coachId' => $this->coachId,
            'roomId' => $this->roomId,
            'fromHouer' => $this->fromHouer,
            'toHouer' => $this->toHouer,
            'period' => $this->period,
            'dayOfWeek' => $this->dayOfWeek
        ];
    }
}
