<?php
namespace App\Http\Services\FundManagement\EditeFund\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeFundInput implements InputServiceInterface
{
    public int $fundId;
    public int $branchId;
    public int $amount;
    public function __construct( array $input)
    {
        $this->fundId = $input['fundId'];
        $this->branchId = $input['branchId'];
        $this->amount = $input['amount'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'fundId'=>$this->fundId,
            'branchId'=>$this->branchId,
            'amount'=>$this->amount
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
