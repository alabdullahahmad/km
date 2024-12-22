<?php
namespace App\Http\Services\PlayerLoginLogManagement\DeletePlayerLoginLog\Controller;

use App\Http\Services\PlayerLoginLogManagement\DeletePlayerLoginLog\logic\DeletePlayerLoginLogInput;
use App\Http\Services\PlayerLoginLogManagement\DeletePlayerLoginLog\logic\DeletePlayerLoginLogLogic;
use App\Http\Controllers\Controller;
use App\Http\Response\SendResponse;
use Illuminate\Http\Request;

class DeletePlayerLoginLogController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new DeletePlayerLoginLogInput($request->all());

        $service = new DeletePlayerLoginLogLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}