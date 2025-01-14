<?php
namespace App\Http\Services\BranchManagement\EditeBranch\Controller;

use App\Http\Services\BranchManagement\EditeBranch\Logic\EditeBranchInput;
use App\Http\Services\BranchManagement\EditeBranch\Logic\EditeBranchLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\BranchManagement\EditeBranch\Request\EditeBranchRequest;
use Illuminate\Http\Request;

class EditeBranchController extends Controller
{
    public function __invoke(EditeBranchRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeBranchInput($request->validated());

        $service = new EditeBranchLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
