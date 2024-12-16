<?php
namespace App\Http\Services\ShowAllUser\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowAllUserInput implements InputServiceInterface
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
