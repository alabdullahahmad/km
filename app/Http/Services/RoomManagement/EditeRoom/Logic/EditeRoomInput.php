<?php
namespace App\Http\Services\RoomManagement\EditeRoom\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeRoomInput implements InputServiceInterface
{
    public int $roomId;
    public string $name;
    public int $capacity;
    public int $branchId;

    public function __construct( array $input)
    {
        $this->roomId = $input['roomId'];
        $this->name = $input['name'];
        $this->capacity = $input['capacity'];
        $this->branchId = $input['branchId'];

    }

    // write your input function here..

    public function toArray(){
        return [
            'name' => $this->name,
            'capacity' => $this->capacity,
            'branchId' => $this->branchId
        ];
    }
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
