<?php
namespace App\Http\Services\FundManagement\EditeFund\Controller;

use App\Http\Services\FundManagement\EditeFund\Logic\EditeFundInput;
use App\Http\Services\FundManagement\EditeFund\Logic\EditeFundLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\FundManagement\AddFund\Request\EditeFundRequest;
use Illuminate\Http\Request;

class EditeFundController extends Controller
{
    public function __invoke(EditeFundRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeFundInput($request->validated());

        $service = new EditeFundLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
