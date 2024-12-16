<?php
namespace App\Http\Services\User\Auth\Login\Controller;

use App\Http\Services\User\Auth\Login\Logic\LoginInput;
use App\Http\Services\User\Auth\Login\Logic\LoginLogic;
use App\Http\Controllers\Controller;
use App\Http\Response\SendResponse;
use App\Http\Services\User\Auth\Login\Request\LoginRequest;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new LoginInput($request->validated());

        $service = new LoginLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
