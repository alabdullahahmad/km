<?php
namespace App\Http\Services\SubscriptionManagement\DeleteSubscription\Controller;

use App\Http\Services\SubscriptionManagement\DeleteSubscription\Logic\DeleteSubscriptionInput;
use App\Http\Services\SubscriptionManagement\DeleteSubscription\Logic\DeleteSubscriptionLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteSubscriptionController extends Controller
{

    public function __invoke(int $id)
    {
        // validate input data and pass it to the service..
        $input = new DeleteSubscriptionInput($id);

        $service = new DeleteSubscriptionLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
