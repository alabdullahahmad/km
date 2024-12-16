<?php
namespace App\Http\Services\RoomManagement\EditeRoom\Controller;

use App\Http\Services\RoomManagement\EditeRoom\Logic\EditeRoomInput;
use App\Http\Services\RoomManagement\EditeRoom\Logic\EditeRoomLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\RoomManagement\EditeRoom\Request\EditRoomRequest;

class EditeRoomController extends Controller
{
    public function __invoke(EditRoomRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeRoomInput($request->validated());

        $service = new EditeRoomLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
