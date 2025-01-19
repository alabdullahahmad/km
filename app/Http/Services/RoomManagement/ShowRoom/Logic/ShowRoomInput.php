<?php
namespace App\Http\Services\RoomManagement\ShowRoom\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowRoomInput implements InputServiceInterface
{
    private int $branchId;
    public function __construct( array $input)
    {
        $this->branchId = $input['branchId'] ?? auth()->branchId;
    }

    // write your input function here..

    public function toArray(){
        return [
            'branchId'=>$this->branchId
        ];
    }

    /**
     * Get the value of branchId
     */
    public function getRoomId()
    {
        return $this->branchId;
    }

    /**
     * Set the value of branchId
     *
     * @return  self
     */
    public function setRoomId($branchId)
    {
        $this->branchId = $branchId;
    }
}
