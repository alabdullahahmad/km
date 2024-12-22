<?php
namespace App\Http\Services\PlayerLoginLogManagement\ViewPlayerLoginLog\logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewPlayerLoginLogInput implements InputServiceInterface
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