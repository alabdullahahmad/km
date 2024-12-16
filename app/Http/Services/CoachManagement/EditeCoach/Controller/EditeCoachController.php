<?php
namespace App\Http\Services\CoachManagement\EditeCoach\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\CoachManagement\EditeCoach\Logic\EditeCoachInput;
use App\Http\Services\CoachManagement\EditeCoach\Logic\EditeCoachLogic;
use App\Http\Services\CoachManagement\EditeCoach\Request\EditeCoachRequest;

class EditeCoachController extends Controller
{
    public function __invoke(EditeCoachRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeCoachInput($request);

        $service = new EditeCoachLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
