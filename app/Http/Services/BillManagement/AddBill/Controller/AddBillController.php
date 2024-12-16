<?php
namespace App\Http\Services\BillManagement\AddBill\Controller;

use App\Http\Services\BillManagement\AddBill\Logic\AddBillInput;
use App\Http\Services\BillManagement\AddBill\Logic\AddBillLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\BillManagement\AddBill\Request\AddBillRequest;
use Illuminate\Support\Facades\Auth;

class AddBillController extends Controller
{
    public function __invoke(AddBillRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddBillInput($request->validated());

        $service = new AddBillLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
