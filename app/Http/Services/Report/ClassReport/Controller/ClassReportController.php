<?php
namespace App\Http\Services\Report\ClassReport\Controller;

use App\Http\Services\Report\ClassReport\Logic\ClassReportInput;
use App\Http\Services\Report\ClassReport\Logic\ClassReportLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\Report\ClassReport\Request\ClassReportRequest;

class ClassReportController extends Controller
{
    public function __invoke(ClassReportRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new ClassReportInput($request->validated());

        $service = new ClassReportLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}