<?php
namespace App\Http\Services\TagManagement\EditeTag\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\TagManagement\EditeTag\Logic\EditeTagInput;
use App\Http\Services\TagManagement\EditeTag\Logic\EditeTagLogic;
use App\Http\Services\TagManagement\EditeTag\Request\EditTagRequest;

class EditeTagController extends Controller
{
    public function __invoke(EditTagRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeTagInput($request->all());

        $service = new EditeTagLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
