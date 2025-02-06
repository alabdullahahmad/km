<?php
namespace App\Http\Services\GetStafLogin\Controller;

use App\Http\Services\GetStafLogin\Logic\GetStafLoginInput;
use App\Http\Services\GetStafLogin\Logic\GetStafLoginLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\GetStafLogin\Request\GetStafLoginRequest;

class GetStafLoginController extends Controller
{
    public function __invoke(GetStafLoginRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new GetStafLoginInput($request->validated());

        $service = new GetStafLoginLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}