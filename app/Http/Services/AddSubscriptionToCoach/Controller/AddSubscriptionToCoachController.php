<?php
namespace App\Http\Services\AddSubscriptionToCoach\Controller;

use App\Http\Services\AddSubscriptionToCoach\Logic\AddSubscriptionToCoachInput;
use App\Http\Services\AddSubscriptionToCoach\Logic\AddSubscriptionToCoachLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\AddSubscriptionToCoach\Request\AddSubscriptionToCoachRequest;

class AddSubscriptionToCoachController extends Controller
{
    public function __invoke(AddSubscriptionToCoachRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddSubscriptionToCoachInput($request->validated());

        $service = new AddSubscriptionToCoachLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}