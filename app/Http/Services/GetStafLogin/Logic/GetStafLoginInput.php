<?php
namespace App\Http\Services\GetStafLogin\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class GetStafLoginInput implements InputServiceInterface
{
    public function __construct( array $input)
    {
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }
}
