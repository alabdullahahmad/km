<?php
namespace App\Http\Services\StafManagement\ViewStaf\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewStafInput implements InputServiceInterface
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