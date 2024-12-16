<?php
namespace App\Http\Services\FundLogManagement\AddFundLog\Controller;

use App\Http\Services\FundLogManagement\AddFundLog\Logic\AddFundLogInput;
use App\Http\Services\FundLogManagement\AddFundLog\Logic\AddFundLogLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\FundLogManagement\AddFundLog\Request\AddFundLogRequest;
use Illuminate\Support\Facades\Auth;

class AddFundLogController extends Controller
{
    public function __invoke(AddFundLogRequest $request)
    {
        $data = $request->all();
        $data['stafId'] = Auth::id();
        // validate input data and pass it to the service..
        $input = new AddFundLogInput($data);

        $service = new AddFundLogLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
