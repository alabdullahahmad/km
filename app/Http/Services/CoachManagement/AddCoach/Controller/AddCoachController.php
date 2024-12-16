<?php
namespace App\Http\Services\CoachManagement\AddCoach\Controller;

use App\Http\Services\CoachManagement\AddCoach\Logic\AddCoachInput;
use App\Http\Services\CoachManagement\AddCoach\Logic\AddCoachLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\CoachManagement\AddCoach\Request\AddCoachRequest;

class AddCoachController extends Controller
{
    public function __invoke(AddCoachRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddCoachInput($request);

        $service = new AddCoachLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
