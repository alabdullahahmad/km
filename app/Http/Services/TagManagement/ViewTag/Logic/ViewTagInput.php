<?php
namespace App\Http\Services\TagManagement\ViewTag\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewTagInput implements InputServiceInterface
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