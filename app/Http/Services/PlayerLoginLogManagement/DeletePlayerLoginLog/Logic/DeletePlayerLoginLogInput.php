<?php
namespace App\Http\Services\PlayerLoginLogManagement\DeletePlayerLoginLog\logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeletePlayerLoginLogInput implements InputServiceInterface
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