<?php
namespace App\Http\Services\TagManagement\ShowTag\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Services\TagManagement\ShowTag\Logic\ShowTagOutput;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowTagLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowTagInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $tagRepository = $this->repository->TagRepository();

        $tag = $tagRepository->readRepository()->find($this->input->getTagId());

        $response  = new ShowTagOutput($tag ,
        SuccessMessages::getKey(SuccessMessages::$show,Attributes::Tag)
        ,viewPath:'tag_management.show_tag');
        return $response->send_as_object();
   }
}
