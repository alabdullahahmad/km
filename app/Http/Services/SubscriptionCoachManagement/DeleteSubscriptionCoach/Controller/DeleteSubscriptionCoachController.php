<?php
namespace App\Http\Services\SubscriptionCoachManagement\DeleteSubscriptionCoach\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\SubscriptionCoachManagement\DeleteSubscriptionCoach\Logic\DeleteSubscriptionCoachInput;
use App\Http\Services\SubscriptionCoachManagement\DeleteSubscriptionCoach\Logic\DeleteSubscriptionCoachLogic;
use App\Http\Services\SubscriptionCoachManagement\DeleteSubscriptionCoach\Request\DeleteSubscriptionCoachRequest;

class DeleteSubscriptionCoachController extends Controller
{
    public function __invoke(DeleteSubscriptionCoachRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new DeleteSubscriptionCoachInput($request->validated());

        $service = new DeleteSubscriptionCoachLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
