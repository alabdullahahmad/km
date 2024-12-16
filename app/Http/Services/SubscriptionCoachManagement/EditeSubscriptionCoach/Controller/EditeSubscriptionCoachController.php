<?php
namespace App\Http\Services\SubscriptionCoachManagement\EditeSubscriptionCoach\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\SubscriptionCoachManagement\EditeSubscriptionCoach\Logic\EditeSubscriptionCoachInput;
use App\Http\Services\SubscriptionCoachManagement\EditeSubscriptionCoach\Logic\EditeSubscriptionCoachLogic;
use App\Http\Services\SubscriptionCoachManagement\EditeSubscriptionCoach\Request\EditSubscriptionCoachRequest;

class EditeSubscriptionCoachController extends Controller
{
    public function __invoke(EditSubscriptionCoachRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeSubscriptionCoachInput($request->validated());

        $service = new EditeSubscriptionCoachLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
