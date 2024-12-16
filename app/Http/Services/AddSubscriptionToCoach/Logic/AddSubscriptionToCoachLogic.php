<?php
namespace App\Http\Services\AddSubscriptionToCoach\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class AddSubscriptionToCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddSubscriptionToCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $coachRepository = $this->repository->CoachRepository();

        $coach = $coachRepository->updateRepository()->update(
            ['id' => $this->input->getCoachId(),],
            $this->input->toArray()
        );

        $response  = new AddSubscriptionToCoachOutput($coach ,
                SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Coache),
                viewPath:'coach_managment.index_coach'
        );
        return $response->send_as_object();
   }
}
