<?php
namespace App\Http\Services\CategoryManagement\ShowCategory\Controller;

use App\Http\Services\CategoryManagement\ShowCategory\Logic\ShowCategoryInput;
use App\Http\Services\CategoryManagement\ShowCategory\Logic\ShowCategoryLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class ShowCategoryController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ShowCategoryInput($request->all());

        $service = new ShowCategoryLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
