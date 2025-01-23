<?php
namespace App\Http\Services\BillManagement\DeleteBill\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\BillManagement\DeleteBill\Logic\DeleteBillInput;
use App\Http\Services\BillManagement\DeleteBill\Logic\DeleteBillLogic;

class DeleteBillController extends Controller
{

    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new DeleteBillInput($request->all());

        $service = new DeleteBillLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}


