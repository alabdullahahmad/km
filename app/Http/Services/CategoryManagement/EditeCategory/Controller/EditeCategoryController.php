<?php
namespace App\Http\Services\CategoryManagement\EditeCategory\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\CategoryManagement\EditeCategory\Logic\EditeCategoryInput;
use App\Http\Services\CategoryManagement\EditeCategory\Logic\EditeCategoryLogic;
use App\Http\Services\CategoryManagement\EditeCategory\Request\EditCategoryRequest;

class EditeCategoryController extends Controller
{
    public function __invoke(EditCategoryRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new EditeCategoryInput($request->all());

        $service = new EditeCategoryLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
