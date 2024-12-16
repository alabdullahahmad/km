<?php
namespace App\Http\Services\GetCoachSubscription\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class GetCoachSubscriptionInput implements InputServiceInterface
{
    private int $coachId;
    public function __construct( array $input)
    {
        $this->coachId = $input['coachId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    /**
     * Get the value of coachId
     * @return int
     */
    public function getCoachId()
    {
        return $this->coachId;
    }

    /**
     * Set the value of coachId
     *
     * @return  self
     */
    public function setCoachId($coachId)
    {
        $this->coachId = $coachId;

        return $this;
    }
}
