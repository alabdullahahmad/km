<?php
namespace App\Http\Services\AddSubscriptionToCoach\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddSubscriptionToCoachInput implements InputServiceInterface
{
    private int $coachId;
    public string $class;
    public function __construct( array $input)
    {
        $this->coachId = $input['coachId'];
        $this->class = $input['class'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'class'=>$this->class
        ];
    }

    /**
     * Get the value of coachId
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
