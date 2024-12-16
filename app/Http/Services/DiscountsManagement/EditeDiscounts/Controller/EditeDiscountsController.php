<?php
namespace App\Http\Services\DiscountsManagement\EditeDiscounts\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\DiscountsManagement\EditeDiscounts\Logic\EditeDiscountsInput;
use App\Http\Services\DiscountsManagement\EditeDiscounts\Logic\EditeDiscountsLogic;
use App\Http\Services\DiscountsManagement\AddDiscounts\Request\EditDiscountsRequest;

class EditeDiscountsController extends Controller
{
    public function __invoke(EditDiscountsRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeDiscountsInput($request->validated());

        $service = new EditeDiscountsLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
