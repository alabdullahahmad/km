<?php
namespace App\Http\Services\CategoryManagement\ViewCategory\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\CategoryManagement\ViewCategory\Logic\ViewCategoryInput;
use App\Http\Services\CategoryManagement\ViewCategory\Logic\ViewCategoryOutput;

class ViewCategoryLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewCategoryInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..

        $categoryRepository = $this->repository->CategoryRepository();
        $categries = $categoryRepository->readRepository()->getAllRecords();

        foreach ($categries as $value) {
            $value->action =  view('category.action')->with(['data'=>$value])->render();
        }

        $response  = new ViewCategoryOutput($categries ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Category)
        ,viewPath:'category_management.show_category');

        return $response->send_as_object();
   }
}
