<?php
namespace App\Http\Services\SubscriptionManagement\EditeSubscription\Controller;

use App\Http\Services\SubscriptionManagement\EditeSubscription\Logic\EditeSubscriptionInput;
use App\Http\Services\SubscriptionManagement\EditeSubscription\Logic\EditeSubscriptionLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\SubscriptionManagement\EditeSubscription\Request\EditSubscriptionRequest;
use Illuminate\Http\Request;

class EditeSubscriptionController extends Controller
{
    public function __invoke(EditSubscriptionRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeSubscriptionInput($request->validated());

        $service = new EditeSubscriptionLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
