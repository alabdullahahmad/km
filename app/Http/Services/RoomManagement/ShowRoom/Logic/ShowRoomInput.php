<?php
namespace App\Http\Services\RoomManagement\ShowRoom\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowRoomInput implements InputServiceInterface
{
    private int $roomId;
    public function __construct( array $input)
    {
        $this->roomId = $input['roomId'];
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
