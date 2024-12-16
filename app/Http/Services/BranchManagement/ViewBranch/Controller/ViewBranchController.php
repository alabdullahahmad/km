<?php
namespace App\Http\Services\BranchManagement\ViewBranch\Controller;

use App\Http\Services\BranchManagement\ViewBranch\Logic\ViewBranchInput;
use App\Http\Services\BranchManagement\ViewBranch\Logic\ViewBranchLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ViewBranchController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewBranchInput($request->all());

        $service = new ViewBranchLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
