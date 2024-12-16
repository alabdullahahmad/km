<?php
namespace App\Http\Services\StafManagement\AddStaf\Controller;

use App\Http\Services\StafManagement\AddStaf\Logic\AddStafInput;
use App\Http\Services\StafManagement\AddStaf\Logic\AddStafLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\StafManagement\AddStaf\Request\AddStafRequest;

class AddStafController extends Controller
{
    public function __invoke(AddStafRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddStafInput($request);

        $service = new AddStafLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
