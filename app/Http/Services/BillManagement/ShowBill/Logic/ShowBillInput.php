<?php
namespace App\Http\Services\BillManagement\ShowBill\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowBillInput implements InputServiceInterface
{
    public function __construct( array $input)
    {
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }
}