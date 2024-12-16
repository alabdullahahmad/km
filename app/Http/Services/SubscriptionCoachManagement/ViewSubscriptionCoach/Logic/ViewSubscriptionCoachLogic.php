<?php
namespace App\Http\Services\SubscriptionCoachManagement\ViewSubscriptionCoach\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\SubscriptionCoachManagement\ViewSubscriptionCoach\Logic\ViewSubscriptionCoachOutput;

class ViewSubscriptionCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewSubscriptionCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $subscriptionCoachRepository = $this->repository->SubscriptionCoachRepository();

        $subscriptionCoachs = $subscriptionCoachRepository->readRepository()->getAllWithRelations(
            ['roomId' => $this->input->getRoomId()]
        );

        $response  = new ViewSubscriptionCoachOutput($subscriptionCoachs ,
        SuccessMessages::getKey(SuccessMessages::$show,Attributes::SubscriptionCoach)
        ,viewPath:'subscription_coach_management.index_subscription_coach');

        return $response->send_as_object();
   }
}
