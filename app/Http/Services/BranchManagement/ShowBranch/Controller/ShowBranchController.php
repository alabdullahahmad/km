<?php
namespace App\Http\Services\BranchManagement\ShowBranch\Controller;

use App\Http\Services\BranchManagement\ShowBranch\Logic\ShowBranchInput;
use App\Http\Services\BranchManagement\ShowBranch\Logic\ShowBranchLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowBranchController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowBranchInput($request->all());

        $service = new ShowBranchLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
