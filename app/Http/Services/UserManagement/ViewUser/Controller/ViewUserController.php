<?php
namespace App\Http\Services\UserManagement\ViewUser\Controller;

use App\Http\Services\UserManagement\ViewUser\Logic\ViewUserInput;
use App\Http\Services\UserManagement\ViewUser\Logic\ViewUserLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ViewUserController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewUserInput($request->all());

        $service = new ViewUserLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
