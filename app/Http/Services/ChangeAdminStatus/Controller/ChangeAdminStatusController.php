<?php
namespace App\Http\Services\ChangeAdminStatus\Controller;

use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\ChangeAdminStatus\logic\ChangeAdminStatusInput;
use App\Http\Services\ChangeAdminStatus\logic\ChangeAdminStatusLogic;
use App\Http\Services\ChangeAdminStatus\Request\ChangeAdminStatusRequest;

class ChangeAdminStatusController extends Controller
{
    public function __invoke(ChangeAdminStatusRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new ChangeAdminStatusInput($request->validated());

        $service = new ChangeAdminStatusLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
