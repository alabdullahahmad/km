<?php
namespace App\Http\Services\BillManagement\ViewBill\Controller;

use App\Http\Services\BillManagement\ViewBill\Logic\ViewBillInput;
use App\Http\Services\BillManagement\ViewBill\Logic\ViewBillLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ViewBillController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewBillInput($request->all());

        $service = new ViewBillLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
