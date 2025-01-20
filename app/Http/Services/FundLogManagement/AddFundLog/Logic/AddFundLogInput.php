<?php
namespace App\Http\Services\FundLogManagement\AddFundLog\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddFundLogInput implements InputServiceInterface
{
    public string $amount;
    public string $date;
    public string $stafId;
    public function __construct( array $input)
    {
        $this->amount = $input['amount'];
        $this->stafId = $input['stafId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'amount' => $this->amount,
            'date' => $this->getDate(),
            'stafId' => $this->stafId,
            'branchId' => auth()->user()->branchId
        ];
    }

    public function getDate(){
        return date('Y-m-d H:i');
    }
}
