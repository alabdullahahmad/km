<?php
namespace App\Http\Services\CoachManagement\ViewCoach\Controller;

use App\Http\Services\CoachManagement\ViewCoach\Logic\ViewCoachInput;
use App\Http\Services\CoachManagement\ViewCoach\Logic\ViewCoachLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ViewCoachController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewCoachInput($request->all());

        $service = new ViewCoachLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }

}
