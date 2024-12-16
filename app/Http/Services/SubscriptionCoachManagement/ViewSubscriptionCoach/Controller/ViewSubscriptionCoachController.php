<?php
namespace App\Http\Services\SubscriptionCoachManagement\ViewSubscriptionCoach\Controller;

use App\Http\Services\SubscriptionCoachManagement\ViewSubscriptionCoach\Logic\ViewSubscriptionCoachInput;
use App\Http\Services\SubscriptionCoachManagement\ViewSubscriptionCoach\Logic\ViewSubscriptionCoachLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\SubscriptionCoachManagement\ViewSubscriptionCoach\Request\ViewSubscriptionCoachRequest;
use Illuminate\Http\Request;

class ViewSubscriptionCoachController extends Controller
{
    public function __invoke(ViewSubscriptionCoachRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewSubscriptionCoachInput($request->all());

        $service = new ViewSubscriptionCoachLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}