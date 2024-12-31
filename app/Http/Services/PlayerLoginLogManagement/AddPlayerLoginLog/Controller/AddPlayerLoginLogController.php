<?php
namespace App\Http\Services\PlayerLoginLogManagement\AddPlayerLoginLog\Controller;

use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\PlayerLoginLogManagement\AddPlayerLoginLog\logic\AddPlayerLoginLogInput;
use App\Http\Services\PlayerLoginLogManagement\AddPlayerLoginLog\logic\AddPlayerLoginLogLogic;
use App\Http\Services\PlayerLoginLogManagement\AddPlayerLoginLog\Request\AddPlayerLoginLogRequest;

class AddPlayerLoginLogController extends Controller
{
    public function __invoke(AddPlayerLoginLogRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddPlayerLoginLogInput($request->validated());

        $service = new AddPlayerLoginLogLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
