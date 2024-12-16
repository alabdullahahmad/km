<?php
namespace App\Http\Services\BranchManagement\DeleteBranch\Controller;

use App\Http\Services\BranchManagement\DeleteBranch\Logic\DeleteBranchInput;
use App\Http\Services\BranchManagement\DeleteBranch\Logic\DeleteBranchLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteBranchController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new DeleteBranchInput($request->all());

        $service = new DeleteBranchLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
