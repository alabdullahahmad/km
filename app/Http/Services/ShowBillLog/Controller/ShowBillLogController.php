<?php
namespace App\Http\Services\ShowBillLog\Controller;

use App\Http\Services\ShowBillLog\Logic\ShowBillLogInput;
use App\Http\Services\ShowBillLog\Logic\ShowBillLogLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\ShowBillLog\Request\ShowBillLogRequest;

class ShowBillLogController extends Controller
{
    public function __invoke(ShowBillLogRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowBillLogInput($request->validated());

        $service = new ShowBillLogLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}