<?php
namespace App\Http\Services\StafManagement\ShowStaf\Controller;

use App\Http\Services\StafManagement\ShowStaf\Logic\ShowStafInput;
use App\Http\Services\StafManagement\ShowStaf\Logic\ShowStafLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowStafController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowStafInput($request->all());

        $service = new ShowStafLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
