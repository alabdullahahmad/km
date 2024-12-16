<?php
namespace App\Http\Services\GetCoachSubscription\Controller;

use App\Http\Services\GetCoachSubscription\Logic\GetCoachSubscriptionInput;
use App\Http\Services\GetCoachSubscription\Logic\GetCoachSubscriptionLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\GetCoachSubscription\Request\GetCoachSubscriptionRequest;

class GetCoachSubscriptionController extends Controller
{
    public function __invoke(GetCoachSubscriptionRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new GetCoachSubscriptionInput($request->validated());

        $service = new GetCoachSubscriptionLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}