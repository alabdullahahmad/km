<?php
namespace App\Http\Services\CategoryManagement\DeleteCategory\Logic;

use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class DeleteCategoryLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories


    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteCategoryInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $categoryRepository = $this->repository->CategoryRepository();

        $category = $categoryRepository->deleteRepository()->delete(['id'=>$this->input->getCategoryId()]);

        $response  = new DeleteCategoryOutput($category ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Category)
        ,viewPath:'category.index',status:302);
        return $response->send_as_object();
   }
}
