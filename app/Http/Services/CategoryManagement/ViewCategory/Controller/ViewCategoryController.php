<?php
namespace App\Http\Services\CategoryManagement\ViewCategory\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\CategoryManagement\ViewCategory\Logic\ViewCategoryInput;
use App\Http\Services\CategoryManagement\ViewCategory\Logic\ViewCategoryLogic;

class ViewCategoryController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate input data and pass it to the service..
        $input = new ViewCategoryInput($request->all());

        $service = new ViewCategoryLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
