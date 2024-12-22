<?php
namespace App\Http\Services\PlayerLoginLogManagement\ShowPlayerLoginLog\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\PlayerLoginLogManagement\ShowPlayerLoginLog\logic\ShowPlayerLoginLogInput;
use App\Http\Services\PlayerLoginLogManagement\ShowPlayerLoginLog\logic\ShowPlayerLoginLogLogic;
use App\Http\Services\PlayerLoginLogManagement\ShowPlayerLoginLog\Request\ShowPlayerLoginLogRequest;

class ShowPlayerLoginLogController extends Controller
{
    public function __invoke(ShowPlayerLoginLogRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowPlayerLoginLogInput($request->all());

        $service = new ShowPlayerLoginLogLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}