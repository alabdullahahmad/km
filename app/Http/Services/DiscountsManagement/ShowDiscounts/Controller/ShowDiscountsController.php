<?php
namespace App\Http\Services\DiscountsManagement\ShowDiscounts\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\DiscountsManagement\ShowDiscounts\Logic\ShowDiscountsInput;
use App\Http\Services\DiscountsManagement\ShowDiscounts\Logic\ShowDiscountsLogic;

class ShowDiscountsController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowDiscountsInput($request->all());

        $service = new ShowDiscountsLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
