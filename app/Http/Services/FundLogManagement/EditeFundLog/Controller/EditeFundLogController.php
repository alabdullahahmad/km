<?php
namespace App\Http\Services\FundLogManagement\EditeFundLog\Controller;

use App\Http\Services\FundLogManagement\EditeFundLog\Logic\EditeFundLogInput;
use App\Http\Services\FundLogManagement\EditeFundLog\Logic\EditeFundLogLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\FundLogManagement\EditeFundLog\Request\EditFundLogRequest;
use Illuminate\Http\Request;

class EditeFundLogController extends Controller
{
    public function __invoke(EditFundLogRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeFundLogInput($request->all());

        $service = new EditeFundLogLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
