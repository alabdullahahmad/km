<?php
namespace App\Http\Services\SubscriptionManagement\ShowSubscription\Controller;

use App\Http\Services\SubscriptionManagement\ShowSubscription\Logic\ShowSubscriptionInput;
use App\Http\Services\SubscriptionManagement\ShowSubscription\Logic\ShowSubscriptionLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowSubscriptionController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowSubscriptionInput($request->all());

        $service = new ShowSubscriptionLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}