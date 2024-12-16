<?php
namespace App\Http\Services\StafManagement\DeleteStaf\Controller;

use App\Http\Services\StafManagement\DeleteStaf\Logic\DeleteStafInput;
use App\Http\Services\StafManagement\DeleteStaf\Logic\DeleteStafLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteStafController extends Controller
{
    public function __invoke($id)
    {
        // validate input data and pass it to the service..
        $input = new DeleteStafInput($id);

        $service = new DeleteStafLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
