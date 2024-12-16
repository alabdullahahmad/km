<?php
namespace App\Http\Services\CoachManagement\AddCoach\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class AddCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $coacheRepository = $this->repository->CoachRepository();

        $data = $this->input->toArray();
        if (!$data['photo']) {
            unset($data['photo']);
        }
        $coache = $coacheRepository->createRepository()->create($this->input->toArray());

        $response  = new AddCoachOutput($coache,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Coache)
        ,viewPath:'handyman.index',status:302
        );
        return $response->send_as_object();
   }
   
}
