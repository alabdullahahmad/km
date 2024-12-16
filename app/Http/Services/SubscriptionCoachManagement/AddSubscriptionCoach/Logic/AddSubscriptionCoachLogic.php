<?php
namespace App\Http\Services\SubscriptionCoachManagement\AddSubscriptionCoach\Logic;

use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class AddSubscriptionCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories


    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddSubscriptionCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $subscriptionCoachRepository = $this->repository->SubscriptionCoachRepository();

        $subscriptionCoach = $subscriptionCoachRepository->createRepository()->create($this->input->toArray());

        $subscriptionCoach =$subscriptionCoach->toArray();
        $response  = new AddSubscriptionCoachOutput($subscriptionCoach ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::SubscriptionCoach)
        ,viewPath:'subscription_coach_management.add_subscription_coach');

        return $response->send_as_object();
   }
}
