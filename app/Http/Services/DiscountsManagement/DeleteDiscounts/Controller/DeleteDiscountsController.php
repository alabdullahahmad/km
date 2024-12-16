<?php
namespace App\Http\Services\DiscountsManagement\DeleteDiscounts\Controller;

use App\Http\Services\DiscountsManagement\DeleteDiscounts\Logic\DeleteDiscountsInput;
use App\Http\Services\DiscountsManagement\DeleteDiscounts\Logic\DeleteDiscountsLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteDiscountsController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new DeleteDiscountsInput($request->all());

        $service = new DeleteDiscountsLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
