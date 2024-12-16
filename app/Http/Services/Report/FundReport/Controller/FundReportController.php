<?php
namespace App\Http\Services\Report\FundReport\Controller;

use App\Http\Services\Report\FundReport\Logic\FundReportInput;
use App\Http\Services\Report\FundReport\Logic\FundReportLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\Report\FundReport\Request\FundReportRequest;

class FundReportController extends Controller
{
    public function __invoke(FundReportRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new FundReportInput($request->validated());

        $service = new FundReportLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}