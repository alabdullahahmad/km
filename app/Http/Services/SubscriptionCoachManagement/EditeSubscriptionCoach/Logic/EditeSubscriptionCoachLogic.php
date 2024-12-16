<?php
namespace App\Http\Services\SubscriptionCoachManagement\EditeSubscriptionCoach\Logic;

use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class EditeSubscriptionCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeSubscriptionCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $subscriptionCoachRepository = $this->repository->SubscriptionCoachRepository();
        $subscriptionCoach = $subscriptionCoachRepository->updateRepository()->update(
            ['id'=>$this->input->getSubscriptionCoachId()],
            $this->input->toArray()
        );

        $response  = new EditeSubscriptionCoachOutput($subscriptionCoach ,
        SuccessMessages::getKey(SuccessMessages::$edit,Attributes::SubscriptionCoach)
        ,viewPath:'subscription_coach_management.edite_subscription_coach');

        return $response->send_as_object();
   }
}

