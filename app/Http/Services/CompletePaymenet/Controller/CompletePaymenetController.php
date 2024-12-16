<?php
namespace App\Http\Services\CompletePaymenet\Controller;

use App\Http\Services\CompletePaymenet\Logic\CompletePaymenetInput;
use App\Http\Services\CompletePaymenet\Logic\CompletePaymenetLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\CompletePaymenet\Request\CompletePaymenetRequest;
use Illuminate\Support\Facades\Auth;

class CompletePaymenetController extends Controller
{
    public function __invoke(CompletePaymenetRequest $request)
    {
        // validate input data and pass it to the service..
        $data = $request->all();
        $data['stafId'] = Auth::id();

        $input = new CompletePaymenetInput($data);

        $service = new CompletePaymenetLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}