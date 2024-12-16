<?php
namespace App\Http\Services\FundLogManagement\ShowFundLog\Controller;

use App\Http\Services\FundLogManagement\ShowFundLog\Logic\ShowFundLogInput;
use App\Http\Services\FundLogManagement\ShowFundLog\Logic\ShowFundLogLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowFundLogController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowFundLogInput($request->all());

        $service = new ShowFundLogLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}