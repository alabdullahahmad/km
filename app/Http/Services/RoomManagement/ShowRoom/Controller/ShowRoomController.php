<?php
namespace App\Http\Services\RoomManagement\ShowRoom\Controller;

use App\Http\Services\RoomManagement\ShowRoom\Logic\ShowRoomInput;
use App\Http\Services\RoomManagement\ShowRoom\Logic\ShowRoomLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowRoomController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowRoomInput($request->all());

        $service = new ShowRoomLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
