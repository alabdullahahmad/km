<?php
namespace App\Http\Services\SubscriptionCoachManagement\DeleteSubscriptionCoach\Logic;

use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class DeleteSubscriptionCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteSubscriptionCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $subscriptionCoachRepository = $this->repository->SubscriptionCoachRepository();

        $subscriptionCoach =$subscriptionCoachRepository->deleteRepository()->delete(
            ['id'=>$this->input->getSubscriptionCoachId()]
        );

        $response  = new DeleteSubscriptionCoachOutput($subscriptionCoach ,
        SuccessMessages::getKey(SuccessMessages::$delete,Attributes::SubscriptionCoach)
        ,viewPath:'subscription_coach_management.delete_subscription_coach');

        return $response->send_as_object();
   }
}
