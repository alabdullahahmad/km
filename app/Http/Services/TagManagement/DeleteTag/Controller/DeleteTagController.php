<?php
namespace App\Http\Services\TagManagement\DeleteTag\Controller;

use App\Http\Services\TagManagement\DeleteTag\Logic\DeleteTagInput;
use App\Http\Services\TagManagement\DeleteTag\Logic\DeleteTagLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteTagController extends Controller
{
public function __invoke($id)
    {
        // validate input data and pass it to the service..
        $input = new DeleteTagInput($id);

        $service = new DeleteTagLogic($input); // call the service's Logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
