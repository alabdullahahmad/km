<?php
namespace App\Http\Services\SubscriptionCoachManagement\ShowSubscriptionCoach\Controller;

use App\Http\Services\SubscriptionCoachManagement\ShowSubscriptionCoach\Logic\ShowSubscriptionCoachInput;
use App\Http\Services\SubscriptionCoachManagement\ShowSubscriptionCoach\Logic\ShowSubscriptionCoachLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowSubscriptionCoachController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowSubscriptionCoachInput($request->all());

        $service = new ShowSubscriptionCoachLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}