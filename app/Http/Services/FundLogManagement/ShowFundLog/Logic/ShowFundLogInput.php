<?php
namespace App\Http\Services\FundLogManagement\ShowFundLog\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowFundLogInput implements InputServiceInterface
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