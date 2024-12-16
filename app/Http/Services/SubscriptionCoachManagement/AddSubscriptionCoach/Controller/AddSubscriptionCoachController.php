<?php
namespace App\Http\Services\SubscriptionCoachManagement\AddSubscriptionCoach\Controller;

use App\Http\Services\SubscriptionCoachManagement\AddSubscriptionCoach\Logic\AddSubscriptionCoachInput;
use App\Http\Services\SubscriptionCoachManagement\AddSubscriptionCoach\Logic\AddSubscriptionCoachLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\SubscriptionCoachManagement\AddSubscriptionCoach\Request\AddSubscriptionCoachRequest;

class AddSubscriptionCoachController extends Controller
{
    public function __invoke(AddSubscriptionCoachRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddSubscriptionCoachInput($request->validated());

        $service = new AddSubscriptionCoachLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}