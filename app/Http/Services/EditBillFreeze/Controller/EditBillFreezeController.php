<?php
namespace App\Http\Services\EditBillFreeze\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\EditBillFreeze\Logic\EditBillFreezeInput;
use App\Http\Services\EditBillFreeze\Logic\EditBillFreezeLogic;
use App\Http\Services\EditBillFreeze\Request\EditBillFreezeRequest;

class EditBillFreezeController extends Controller
{
    public function __invoke(EditBillFreezeRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditBillFreezeInput($request->validated());

        $service = new EditBillFreezeLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
