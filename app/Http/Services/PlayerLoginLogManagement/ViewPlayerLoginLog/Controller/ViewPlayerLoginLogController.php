<?php
namespace App\Http\Services\PlayerLoginLogManagement\ViewPlayerLoginLog\Controller;

use App\Http\Services\PlayerLoginLogManagement\ViewPlayerLoginLog\logic\ViewPlayerLoginLogInput;
use App\Http\Services\PlayerLoginLogManagement\ViewPlayerLoginLog\logic\ViewPlayerLoginLogLogic;
use App\Http\Controllers\Controller;
use App\Http\Response\SendResponse;
use Illuminate\Http\Request;

class ViewPlayerLoginLogController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewPlayerLoginLogInput($request->all());

        $service = new ViewPlayerLoginLogLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}