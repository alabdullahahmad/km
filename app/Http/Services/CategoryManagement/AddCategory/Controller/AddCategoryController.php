<?php
namespace App\Http\Services\CategoryManagement\AddCategory\Controller;

use App\Http\Services\CategoryManagement\AddCategory\Logic\AddCategoryInput;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use App\Http\Services\CategoryManagement\AddCategory\Logic\AddCategoryLogic;
use App\Http\Services\CategoryManagement\AddCategory\Request\AddCategoryRequest;

class AddCategoryController extends Controller
{
    public function __invoke(AddCategoryRequest $request)
    {
        // validate input data and pass it to the service..
        $input = new AddCategoryInput($request->validated());

        $service = new AddCategoryLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}
