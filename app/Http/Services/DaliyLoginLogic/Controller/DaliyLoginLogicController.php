<?php
namespace App\Http\Services\DaliyLoginLogic\Controller;

use App\Http\Services\DaliyLoginLogic\Logic\DaliyLoginLogicInput;
use App\Http\Services\DaliyLoginLogic\Logic\DaliyLoginLogicLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\DaliyLoginLogic\Request\DaliyLoginLogicRequest;

class DaliyLoginLogicController extends Controller
{
    public function __invoke(DaliyLoginLogicRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new DaliyLoginLogicInput($request->validated());

        $service = new DaliyLoginLogicLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}