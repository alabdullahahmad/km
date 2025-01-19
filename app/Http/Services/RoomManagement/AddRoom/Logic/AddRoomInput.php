<?php
namespace App\Http\Services\RoomManagement\AddRoom\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddRoomInput implements InputServiceInterface
{
    public string $name;
    public int $capacity;
    public int $branchId;

    public function __construct( array $input)
    {
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
}
