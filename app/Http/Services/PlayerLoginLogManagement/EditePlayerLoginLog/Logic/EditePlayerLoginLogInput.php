<?php
namespace App\Http\Services\PlayerLoginLogManagement\EditePlayerLoginLog\logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditePlayerLoginLogInput implements InputServiceInterface
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