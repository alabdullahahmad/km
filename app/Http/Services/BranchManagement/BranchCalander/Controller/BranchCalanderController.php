<?php
namespace App\Http\Services\BranchManagement\BranchCalander\Controller;

use App\Http\Services\BranchManagement\BranchCalander\Logic\BranchCalanderInput;
use App\Http\Services\BranchManagement\BranchCalander\Logic\BranchCalanderLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class BranchCalanderController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new BranchCalanderInput($request->all());

        $service = new BranchCalanderLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
