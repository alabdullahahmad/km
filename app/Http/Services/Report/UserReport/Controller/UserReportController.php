<?php
namespace App\Http\Services\Report\UserReport\Controller;

use App\Http\Services\Report\UserReport\Logic\UserReportInput;
use App\Http\Services\Report\UserReport\Logic\UserReportLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\Report\UserReport\Request\UserReportRequest;

class UserReportController extends Controller
{
    public function __invoke(UserReportRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new UserReportInput($request->validated());

        $service = new UserReportLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}