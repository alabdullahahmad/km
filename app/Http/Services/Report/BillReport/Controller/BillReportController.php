<?php
namespace App\Http\Services\Report\BillReport\Controller;

use App\Http\Services\Report\BillReport\Logic\BillReportInput;
use App\Http\Services\Report\BillReport\Logic\BillReportLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\Report\BillReport\Request\BillReportRequest;

class BillReportController extends Controller
{
    public function __invoke(BillReportRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new BillReportInput($request->validated());

        $service = new BillReportLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}