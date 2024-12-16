<?php
namespace App\Http\Services\CoachManagement\DeleteCoach\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class DeleteCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $coacheRepository = $this->repository->CoachRepository();

        $coache = $coacheRepository->deleteRepository()->delete([
            'id' => $this->input->getCoacheId(),
        ]);

        // removeImage($coache->photo);

        $response  = new DeleteCoachOutput($coache ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Coache)
      
        );
        return $response->send_as_object();
   }
   
}
