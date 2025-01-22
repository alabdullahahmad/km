<?php
namespace App\Http\Services\BillManagement\EditUserBill\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\BillManagement\EditUserBill\Logic\EditUserBillInput;
use App\Http\Services\BillManagement\EditUserBill\Logic\EditUserBillLogic;
use App\Http\Services\BillManagement\EditUserBill\Request\EditUserBillRequest;

class EditUserBillController extends Controller
{
    public function __invoke(EditUserBillRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditUserBillInput($request->validated());

        $service = new EditUserBillLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
