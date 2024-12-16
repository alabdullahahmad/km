<?php
namespace App\Http\Services\BillManagement\ShowBill\Controller;

use App\Http\Services\BillManagement\ShowBill\Logic\ShowBillInput;
use App\Http\Services\BillManagement\ShowBill\Logic\ShowBillLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowBillController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowBillInput($request->all());

        $service = new ShowBillLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
