<?php
namespace App\Http\Services\Report\UserReportDetails\Controller;

use App\Http\Services\Report\UserReportDetails\Logic\UserReportDetailsInput;
use App\Http\Services\Report\UserReportDetails\Logic\UserReportDetailsLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\Report\UserReportDetails\Request\UserReportDetailsRequest;

class UserReportDetailsController extends Controller
{
    public function __invoke(UserReportDetailsRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new UserReportDetailsInput($request->validated());

        $service = new UserReportDetailsLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}