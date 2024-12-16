<?php
namespace App\Http\Services\TagManagement\AddTag\Controller;

use App\Http\Services\TagManagement\AddTag\Logic\AddTagInput;
use App\Http\Services\TagManagement\AddTag\Logic\AddTagLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\TagManagement\AddTag\Request\AddTagRequest;

class AddTagController extends Controller
{
    public function __invoke(AddTagRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddTagInput($request->validated());

        $service = new AddTagLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
