<?php
namespace App\Http\Services\UserManagement\DeleteUser\Controller;

use App\Http\Services\UserManagement\DeleteUser\Logic\DeleteUserInput;
use App\Http\Services\UserManagement\DeleteUser\Logic\DeleteUserLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteUserController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new DeleteUserInput($request->all());

        $service = new DeleteUserLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
