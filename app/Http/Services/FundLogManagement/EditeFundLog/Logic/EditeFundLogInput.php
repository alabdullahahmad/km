<?php
namespace App\Http\Services\FundLogManagement\EditeFundLog\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeFundLogInput implements InputServiceInterface
{
    private int $fundLogId;
    public function __construct( array $input)
    {
        $this->fundLogId = $input['fundLogId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'adminRecipient'=>true
        ];
    }

    /**
     * Get the value of fundLogId
     */
    public function getFundLogId()
    {
        return $this->fundLogId;
    }

    /**
     * Set the value of fundLogId
     *
     * @return  self
     */
    public function setFundLogId($fundLogId)
    {
        $this->fundLogId = $fundLogId;

        return $this;
    }
}
