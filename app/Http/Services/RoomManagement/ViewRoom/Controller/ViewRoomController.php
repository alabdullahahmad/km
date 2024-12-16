<?php
namespace App\Http\Services\RoomManagement\ViewRoom\Controller;

use App\Http\Services\RoomManagement\ViewRoom\Logic\ViewRoomInput;
use App\Http\Services\RoomManagement\ViewRoom\Logic\ViewRoomLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ViewRoomController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewRoomInput($request->all());

        $service = new ViewRoomLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
