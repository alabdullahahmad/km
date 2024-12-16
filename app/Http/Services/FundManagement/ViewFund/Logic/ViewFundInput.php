<?php
namespace App\Http\Services\FundManagement\ViewFund\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewFundInput implements InputServiceInterface
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