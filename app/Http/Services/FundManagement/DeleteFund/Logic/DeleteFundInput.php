<?php
namespace App\Http\Services\FundManagement\DeleteFund\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeleteFundInput implements InputServiceInterface
{
    private int $fundId;
    public function __construct( array $input)
    {
        $this->fundId = $input['fundId'];
    }


    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    /**
     * Get the value of fundId
     */
    public function getFundId()
    {
        return $this->fundId;
    }

    /**
     * Set the value of fundId
     *
     * @return  self
     */
    public function setFundId($fundId)
    {
        $this->fundId = $fundId;

        return $this;
    }
}
