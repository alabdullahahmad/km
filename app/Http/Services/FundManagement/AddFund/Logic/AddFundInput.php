<?php
namespace App\Http\Services\FundManagement\AddFund\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddFundInput implements InputServiceInterface
{
    public int $branchId;
    public ?int $amount;
    public function __construct( array $input)
    {
        $this->branchId = $input['branchId'];
        $this->amount = $input['amount'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'branchId'=>$this->branchId,
            'amount'=>$this->amount
        ];
    }
}
