<?php
namespace App\Http\Services\UserManagement\EditeUser\Controller;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\UserManagement\EditeUser\Logic\EditeUserInput;
use App\Http\Services\UserManagement\EditeUser\Logic\EditeUserLogic;
use App\Http\Services\UserManagement\EditeUser\Request\EditUserRequest;


class EditeUserController extends Controller
{
    public function __invoke(EditUserRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeUserInput($request->validated());

        $service = new EditeUserLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
