<?php
namespace App\Http\Services\ShowAllUser\Controller;

use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\ShowAllUser\logic\ShowAllUserInput;
use App\Http\Services\ShowAllUser\logic\ShowAllUserLogic;
use App\Http\Services\ShowAllUser\Request\ShowAllUserRequest;

class ShowAllUserController extends Controller
{
    public function __invoke(ShowAllUserRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowAllUserInput($request->validated());

        $service = new ShowAllUserLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
