<?php
namespace App\Http\Services\Report\ComplexReport\Controller;

use App\Http\Services\Report\ComplexReport\Logic\ComplexReportInput;
use App\Http\Services\Report\ComplexReport\Logic\ComplexReportLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\Report\ComplexReport\Request\ComplexReportRequest;

class ComplexReportController extends Controller
{
    public function __invoke(ComplexReportRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new ComplexReportInput($request->validated());

        $service = new ComplexReportLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
