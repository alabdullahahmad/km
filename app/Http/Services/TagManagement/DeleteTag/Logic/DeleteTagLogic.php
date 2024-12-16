<?php
namespace App\Http\Services\TagManagement\DeleteTag\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\TagManagement\DeleteTag\Logic\DeleteTagOutput;

class DeleteTagLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteTagInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $tagRepository = $this->repository->TagRepository();

        $tag = $tagRepository->deleteRepository()->delete(
            ['id' => $this->input->getTagId()]
        );

        $response  = new DeleteTagOutput($tag ,
        SuccessMessages::getKey(SuccessMessages::$delete,Attributes::Tag)
        ,viewPath:'tag_management.delete_tag');
        
        return $response->send_as_object();
   }
}
