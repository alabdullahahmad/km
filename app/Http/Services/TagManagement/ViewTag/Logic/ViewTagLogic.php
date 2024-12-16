<?php
namespace App\Http\Services\TagManagement\ViewTag\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Services\TagManagement\ViewTag\Logic\ViewTagOutput;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ViewTagLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewTagInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $tagRepository = $this->repository->TagRepository();

        $tags = $tagRepository->readRepository()->getAllRecords();
        foreach ($tags as $value) {
            $value->category;
            $value->action =  view('subcategory.action')->with(['data'=>$value])->render();
        }
        $response  = new ViewTagOutput($tags, SuccessMessages::getKey(SuccessMessages::$show,Attributes::Tag)
        ,viewPath:'tag_management.show_tag');

        return $response->send_as_object();
   }
}
