<?php
namespace App\Http\Services\RoomManagement\DeleteRoom\Controller;

use App\Http\Services\RoomManagement\DeleteRoom\Logic\DeleteRoomInput;
use App\Http\Services\RoomManagement\DeleteRoom\Logic\DeleteRoomLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteRoomController extends Controller
{
    public function __invoke($roomId)
    {
        // validate input data and pass it to the service..
        $input = new DeleteRoomInput($roomId);

        $service = new DeleteRoomLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
