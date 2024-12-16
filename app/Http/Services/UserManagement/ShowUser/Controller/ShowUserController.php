<?php
namespace App\Http\Services\UserManagement\ShowUser\Controller;

use App\Http\Services\UserManagement\ShowUser\Logic\ShowUserInput;
use App\Http\Services\UserManagement\ShowUser\Logic\ShowUserLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowUserController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowUserInput($request->all());

        $service = new ShowUserLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();


        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
