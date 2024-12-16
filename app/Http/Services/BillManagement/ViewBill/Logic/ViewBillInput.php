<?php
namespace App\Http\Services\BillManagement\ViewBill\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewBillInput implements InputServiceInterface
{
    public function __construct( array $input)
    {}

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }
}