<?php
namespace App\Http\Services\TagManagement\ShowTag\Controller;

use App\Http\Services\TagManagement\ShowTag\Logic\ShowTagInput;
use App\Http\Services\TagManagement\ShowTag\Logic\ShowTagLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowTagController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowTagInput($request->all());

        $service = new ShowTagLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}