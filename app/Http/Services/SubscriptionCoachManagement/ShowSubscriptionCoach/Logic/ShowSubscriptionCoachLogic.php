<?php
namespace App\Http\Services\SubscriptionCoachManagement\ShowSubscriptionCoach\Logic;
use GrahamCampbell\ResultType\Success;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\SubscriptionCoachManagement\ShowSubscriptionCoach\Logic\ShowSubscriptionCoachOutput;

class ShowSubscriptionCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowSubscriptionCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $subscriptionCoachRepository = $this->repository->SubscriptionCoachRepository();

        $subscriptionCoach = $subscriptionCoachRepository->readRepository()->getWithRelations(
            $this->input->getSubscriptionCoachId()
        );


        $response  = new ShowSubscriptionCoachOutput($subscriptionCoach ,
        SuccessMessages::getKey(SuccessMessages::$show,Attributes::SubscriptionCoach)
        ,viewPath:'subscription_coach_management.show_subscription_coach');

        return $response->send_as_object();
   }
}
