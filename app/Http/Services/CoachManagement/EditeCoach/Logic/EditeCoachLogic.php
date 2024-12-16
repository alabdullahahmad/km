<?php
namespace App\Http\Services\CoachManagement\EditeCoach\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use Illuminate\Support\Facades\Hash;

class EditeCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $coacheRepository = $this->repository->CoachRepository();

        $data = $this->input->toArray();

        if ($this->input->photo) {
            $data['photo'] = $this->input->getPhoto();
        }

        if ($this->input->class) {
            $data['class'] = $this->input->getClass();
        }
        $coacheRepository->updateRepository()->update(
            ['id' => $this->input->getCoacheId()] ,
            $data
        );



        $response  = new EditeCoachOutput( $coacheRepository, SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Coache)
        ,viewPath:'handyman.index'
        ,status:302
    );
        return $response->send_as_object();
   }
}
