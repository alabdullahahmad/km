<?php
namespace App\Http\Services\ShowBillLog\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowBillLogInput implements InputServiceInterface
{
    public int $billId;
    public function __construct( array $input)
    {
        $this->billId = $input['billId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    public function getBillId(){
        return $this->billId;
    }
}