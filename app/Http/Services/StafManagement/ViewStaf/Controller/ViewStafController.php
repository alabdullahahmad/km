<?php
namespace App\Http\Services\StafManagement\ViewStaf\Controller;

use App\Http\Services\StafManagement\ViewStaf\Logic\ViewStafInput;
use App\Http\Services\StafManagement\ViewStaf\Logic\ViewStafLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ViewStafController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewStafInput($request->all());

        $service = new ViewStafLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
