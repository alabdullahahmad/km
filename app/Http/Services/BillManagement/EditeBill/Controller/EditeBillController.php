<?php
namespace App\Http\Services\BillManagement\EditeBill\Controller;

use App\Http\Services\BillManagement\EditeBill\Logic\EditeBillInput;
use App\Http\Services\BillManagement\EditeBill\Logic\EditeBillLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\BillManagement\EditeBill\Request\EditeBillRequest;
use Illuminate\Http\Request;

class EditeBillController extends Controller
{
    public function __invoke(EditeBillRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeBillInput($request->validated());

        $service = new EditeBillLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
