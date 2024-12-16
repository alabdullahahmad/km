<?php
namespace App\Http\Services\UserManagement\AddUser\Controller;

use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\UserManagement\AddUser\Logic\AddUserInput;
use App\Http\Services\UserManagement\AddUser\Logic\AddUserLogic;
use App\Http\Services\UserManagement\AddUser\Request\AddUserRequest;

class AddUserController extends Controller
{
    public function __invoke(AddUserRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddUserInput($request->validated());

        $service = new AddUserLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
