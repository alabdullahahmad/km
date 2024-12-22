<?php
namespace App\Http\Services\PlayerLoginLogManagement\EditePlayerLoginLog\Controller;

use App\Http\Services\PlayerLoginLogManagement\EditePlayerLoginLog\logic\EditePlayerLoginLogInput;
use App\Http\Services\PlayerLoginLogManagement\EditePlayerLoginLog\logic\EditePlayerLoginLogLogic;
use App\Http\Controllers\Controller;
use App\Http\Response\SendResponse;
use Illuminate\Http\Request;

class EditePlayerLoginLogController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new EditePlayerLoginLogInput($request->all());

        $service = new EditePlayerLoginLogLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}