<?php
namespace App\Http\Services\ShowSubscription\Controller;

use App\Http\Services\ShowSubscription\Logic\ShowSubscriptionInput;
use App\Http\Services\ShowSubscription\Logic\ShowSubscriptionLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\ShowSubscription\Request\ShowSubscriptionRequest;

class ShowSubscriptionController extends Controller
{
    public function __invoke(ShowSubscriptionRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowSubscriptionInput($request->validated());

        $service = new ShowSubscriptionLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}