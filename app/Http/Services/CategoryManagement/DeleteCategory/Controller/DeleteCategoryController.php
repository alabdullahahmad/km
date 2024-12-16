<?php
namespace App\Http\Services\CategoryManagement\DeleteCategory\Controller;

use App\Http\Services\CategoryManagement\DeleteCategory\Logic\DeleteCategoryInput;
use App\Http\Services\CategoryManagement\DeleteCategory\Logic\DeleteCategoryLogic;
use App\Http\Controllers\Controller;
use App\Http\Core\Response\SendResponse;
use Illuminate\Http\Request;

class DeleteCategoryController extends Controller
{
    public function __invoke($id)
    {
        // validate input data and pass it to the service..
        $input = new DeleteCategoryInput($id);

        $service = new DeleteCategoryLogic($input); // call the service's logic

        // execute service and get result..
        $result = $service->execute();

        return SendResponse::sendSuccessResponse($result); // send response..
    }
}


