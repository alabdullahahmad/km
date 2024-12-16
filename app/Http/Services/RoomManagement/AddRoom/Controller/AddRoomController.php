<?php
namespace App\Http\Services\RoomManagement\AddRoom\Controller;

use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\RoomManagement\AddRoom\Logic\AddRoomInput;
use App\Http\Services\RoomManagement\AddRoom\Logic\AddRoomLogic;
use App\Http\Services\RoomManagement\AddRoom\Request\AddRoomRequest;

class AddRoomController extends Controller
{
    public function __invoke(AddRoomRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddRoomInput($request->validated());

        $service = new AddRoomLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
