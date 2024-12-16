<?php
namespace App\Http\Services\DiscountsManagement\AddDiscounts\Controller;

use App\Http\Services\DiscountsManagement\AddDiscounts\Logic\AddDiscountsInput;
use App\Http\Services\DiscountsManagement\AddDiscounts\Logic\AddDiscountsLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\DiscountsManagement\AddDiscounts\Request\AddDiscountsRequest;

class AddDiscountsController extends Controller
{
    public function __invoke(AddDiscountsRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddDiscountsInput($request->validated());

        $service = new AddDiscountsLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
