<?php
namespace App\Http\Services\FundManagement\DeleteFund\Controller;

use App\Http\Services\FundManagement\DeleteFund\Logic\DeleteFundInput;
use App\Http\Services\FundManagement\DeleteFund\Logic\DeleteFundLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteFundController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new DeleteFundInput($request->all());

        $service = new DeleteFundLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}