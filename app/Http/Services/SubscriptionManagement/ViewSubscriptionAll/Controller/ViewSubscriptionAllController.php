<?php
namespace App\Http\services\SubscriptionManagement\ViewSubscriptionAll\Controller;

use App\Http\Services\SubscriptionManagement\ViewSubscription\Logic\ViewSubscriptionLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\services\SubscriptionManagement\ViewSubscriptionAll\Logic\ViewSubscriptionAllInput;
use App\Http\services\SubscriptionManagement\ViewSubscriptionAll\Logic\ViewSubscriptionAllLogic;
use Illuminate\Http\Request;

class ViewSubscriptionAllController extends Controller
{
    public function __invoke()
    {
        // validate input data and pass it to the service..
        $input = new ViewSubscriptionAllInput();

        $service = new ViewSubscriptionAllLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
