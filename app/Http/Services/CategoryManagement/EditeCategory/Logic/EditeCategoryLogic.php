<?php
namespace App\Http\Services\CategoryManagement\EditeCategory\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\CategoryManagement\EditeCategory\Logic\EditeCategoryInput;
use App\Http\Services\CategoryManagement\EditeCategory\Logic\EditeCategoryOutput;

class EditeCategoryLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeCategoryInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $categroryRepository = $this->repository->CategoryRepository();

        $category = $categroryRepository->updateRepository()->update(
            ['id' => $this->input->getCategoryId()],
            $this->input->toArray()
        );

        $response  = new EditeCategoryOutput($category ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Category)
        ,viewPath:'category.index',
        status:302);
        return $response->send_as_object();
   }
}
