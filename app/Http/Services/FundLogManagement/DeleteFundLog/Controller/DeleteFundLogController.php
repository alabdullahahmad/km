<?php
namespace App\Http\Services\FundLogManagement\DeleteFundLog\Controller;

use App\Http\Services\FundLogManagement\DeleteFundLog\Logic\DeleteFundLogInput;
use App\Http\Services\FundLogManagement\DeleteFundLog\Logic\DeleteFundLogLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteFundLogController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new DeleteFundLogInput($request->all());

        $service = new DeleteFundLogLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}