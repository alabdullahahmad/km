<?php
namespace App\Http\Services\TagManagement\AddTag\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Services\TagManagement\AddTag\Logic\AddTagOutput;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class AddTagLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddTagInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $tagRepository = $this->repository->TagRepository();

        $tag = $tagRepository->createRepository()->create(
            $this->input->toArray()
        );

        $response  = new AddTagOutput($tag ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Tag)
        ,viewPath:'subcategory.index',
        status:302);

        return $response->send_as_object();
   }
}
