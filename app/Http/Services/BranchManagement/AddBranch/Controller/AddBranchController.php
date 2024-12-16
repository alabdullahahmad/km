<?php
namespace App\Http\Services\BranchManagement\AddBranch\Controller;

use App\Http\Services\BranchManagement\AddBranch\Logic\AddBranchInput;
use App\Http\Services\BranchManagement\AddBranch\Logic\AddBranchLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\BranchManagement\AddBranch\Request\AddBranchRequest;

class AddBranchController extends Controller
{
    public function __invoke(AddBranchRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddBranchInput($request);

        $service = new AddBranchLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
