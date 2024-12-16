<?php
namespace App\Http\Services\DiscountsManagement\ViewDiscounts\Controller;

use App\Http\Services\DiscountsManagement\ViewDiscounts\Logic\ViewDiscountsInput;
use App\Http\Services\DiscountsManagement\ViewDiscounts\Logic\ViewDiscountsLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ViewDiscountsController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewDiscountsInput($request->all());

        $service = new ViewDiscountsLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
