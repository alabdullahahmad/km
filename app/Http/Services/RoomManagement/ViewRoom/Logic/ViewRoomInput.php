<?php
namespace App\Http\Services\RoomManagement\ViewRoom\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewRoomInput implements InputServiceInterface
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
