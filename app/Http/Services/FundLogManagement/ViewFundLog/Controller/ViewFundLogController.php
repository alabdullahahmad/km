<?php
namespace App\Http\Services\FundLogManagement\ViewFundLog\Controller;

use App\Http\Services\FundLogManagement\ViewFundLog\Logic\ViewFundLogInput;
use App\Http\Services\FundLogManagement\ViewFundLog\Logic\ViewFundLogLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ViewFundLogController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewFundLogInput($request->all());

        $service = new ViewFundLogLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}