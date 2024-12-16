<?php
namespace App\Http\Services\FundManagement\AddFund\Controller;

use App\Http\Services\FundManagement\AddFund\Logic\AddFundInput;
use App\Http\Services\FundManagement\AddFund\Logic\AddFundLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\FundManagement\AddFund\Request\AddFundRequest;

class AddFundController extends Controller
{
    public function __invoke(AddFundRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddFundInput($request->validated());

        $service = new AddFundLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
