<?php
namespace App\Http\Services\StafManagement\DeleteStaf\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeleteStafInput implements InputServiceInterface
{
    private int $stafId;
    public function __construct(  $stafId)
    {
        $this->stafId = $stafId;
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    /**
     * Get the value of stafId
     */ 
    public function getStafId()
    {
        return $this->stafId;
    }

    /**
     * Set the value of stafId
     *
     * @return  self
     */ 
    public function setStafId($stafId)
    {
        $this->stafId = $stafId;

        return $this;
    }
}