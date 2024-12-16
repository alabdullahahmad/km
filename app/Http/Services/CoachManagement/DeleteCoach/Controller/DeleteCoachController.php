<?php
namespace App\Http\Services\CoachManagement\DeleteCoach\Controller;

use App\Http\Services\CoachManagement\DeleteCoach\Logic\DeleteCoachInput;
use App\Http\Services\CoachManagement\DeleteCoach\Logic\DeleteCoachLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteCoachController extends Controller
{

    public function __invoke($id)
    {
        // validate input data and pass it to the service..
        $input = new DeleteCoachInput($id);

        $service = new DeleteCoachLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
