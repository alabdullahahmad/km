<?php
namespace App\Http\Services\TagManagement\EditeTag\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\TagManagement\EditeTag\Logic\EditeTagOutput;
use App\Http\Services\TagManagement\EditeTag\Logic\EditeTagInput;

class EditeTagLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeTagInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $tagRepository = $this->repository->TagRepository();
        $tag = $tagRepository->updateRepository()->update(
            ['id' => $this->input->getTagId()],
            $this->input->toArray()
        );

        $response  = new EditeTagOutput($tag ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Tag)
        ,viewPath:'subcategory.index',
        status:302);

        return $response->send_as_object();
   }
}
