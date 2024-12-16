<?php
namespace App\Http\Services\CoachManagement\DeleteCoach\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeleteCoachInput implements InputServiceInterface
{
    private int $coacheId;
    public function __construct($input)
    {
        $this->coacheId = $input;
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    /**
     * Get the value of coacheId
     */
    public function getCoacheId()
    {
        return $this->coacheId;
    }

    /**
     * Set the value of coacheId
     *
     * @return  self
     */
    public function setCoacheId($coacheId)
    {
        $this->coacheId = $coacheId;

        return $this;
    }
}
