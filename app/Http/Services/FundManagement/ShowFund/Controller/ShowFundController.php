<?php
namespace App\Http\Services\FundManagement\ShowFund\Controller;

use App\Http\Services\FundManagement\ShowFund\Logic\ShowFundInput;
use App\Http\Services\FundManagement\ShowFund\Logic\ShowFundLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowFundController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowFundInput($request->all());

        $service = new ShowFundLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
