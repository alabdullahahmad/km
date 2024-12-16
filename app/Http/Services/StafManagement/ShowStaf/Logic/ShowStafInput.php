<?php
namespace App\Http\Services\StafManagement\ShowStaf\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowStafInput implements InputServiceInterface
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