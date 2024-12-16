<?php
namespace App\Http\Services\FundLogManagement\ViewFundLog\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewFundLogInput implements InputServiceInterface
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