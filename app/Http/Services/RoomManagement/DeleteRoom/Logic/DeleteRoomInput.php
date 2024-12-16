<?php
namespace App\Http\Services\RoomManagement\DeleteRoom\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeleteRoomInput implements InputServiceInterface
{
    private int $roomId;
    public function __construct(  $input)
    {
        $this->roomId = $input;
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    /**
     * Get the value of roomId
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * Set the value of roomId
     *
     * @return  self
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }
}
