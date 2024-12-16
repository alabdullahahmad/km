<?php
namespace App\Http\Services\CoachManagement\ShowCoach\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $coacheRepository = $this->repository->CoachRepository();

        $coache = $coacheRepository->readRepository()->find($this->input->getCoacheId());

        $response  = new ShowCoachOutput($coache ,
        SuccessMessages::getKey(SuccessMessages::$show,Attributes::Coache)
        ,viewPath:'coache_management.show_coache'
        );
        return $response->send_as_object();
   }
}
