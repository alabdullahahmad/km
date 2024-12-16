<?php
namespace App\Http\Services\DiscountsManagement\ViewDiscounts\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewDiscountsInput implements InputServiceInterface
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