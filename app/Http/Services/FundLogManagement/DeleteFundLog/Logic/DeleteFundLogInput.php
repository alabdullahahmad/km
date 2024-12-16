<?php
namespace App\Http\Services\FundLogManagement\DeleteFundLog\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeleteFundLogInput implements InputServiceInterface
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