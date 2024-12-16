<?php
namespace App\Http\Services\StafManagement\EditeStaf\Controller;

use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\StafManagement\EditeStaf\Logic\EditeStafInput;
use App\Http\Services\StafManagement\EditeStaf\Logic\EditeStafLogic;
use App\Http\Services\StafManagement\EditeStaf\Request\EditeStafRequest;

class EditeStafController extends Controller
{
    public function __invoke(EditeStafRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeStafInput($request);

        $service = new EditeStafLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
