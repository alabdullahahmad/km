<?php
namespace App\Http\Services\EditBillDate\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\EditBillDate\Logic\EditBillDateInput;
use App\Http\Services\EditBillDate\Logic\EditBillDateLogic;
use App\Http\Services\EditBillDate\Request\EditBillDateRequest;

class EditBillDateController extends Controller
{
    public function __invoke(EditBillDateRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditBillDateInput($request->validated());

        $service = new EditBillDateLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
