<?php
namespace App\Http\Services\CoachManagement\ShowCoach\Controller;

use App\Http\Services\CoachManagement\ShowCoach\Logic\ShowCoachInput;
use App\Http\Services\CoachManagement\ShowCoach\Logic\ShowCoachLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowCoachController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowCoachInput($request->all());

        $service = new ShowCoachLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
