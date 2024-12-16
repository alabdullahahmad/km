<?php
namespace App\Http\Services\RoomManagement\EditeRoom\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeRoomInput implements InputServiceInterface
{
    public int $roomId;
    public string $name;
    public int $capacity;
    public function __construct( array $input)
    {
        $this->roomId = $input['roomId'];
        $this->name = $input['name'];
        $this->capacity = $input['capacity'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'name' => $this->name,
            'capacity' => $this->capacity
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
