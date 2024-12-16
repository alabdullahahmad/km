<?php
namespace App\Http\Services\TagManagement\ViewTag\Controller;

use App\Http\Services\TagManagement\ViewTag\Logic\ViewTagInput;
use App\Http\Services\TagManagement\ViewTag\Logic\ViewTagLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ViewTagController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewTagInput($request->all());

        $service = new ViewTagLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
