<?php
namespace App\Http\Services\SubscriptionManagement\ViewSubscription\Controller;

use App\Http\Services\SubscriptionManagement\ViewSubscription\Logic\ViewSubscriptionInput;
use App\Http\Services\SubscriptionManagement\ViewSubscription\Logic\ViewSubscriptionLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ViewSubscriptionController extends Controller
{
    public function __invoke(int $categoryId)
    {
        // validate input data and pass it to the service..
        $input = new ViewSubscriptionInput($categoryId);

        $service = new ViewSubscriptionLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
