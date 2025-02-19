<?php

namespace App\Http\Services\ShowSubscription\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\ShowSubscription\Logic\ShowSubscriptionOutput;
use Attribute;

class ShowSubscriptionLogic implements Service
{

    private RepositoryCaller $repository; // access to all model's repositories

    public function __construct(
        //---------------------------------------------------------------------------------------
        private ShowSubscriptionInput $input,  /*| Pass Request To Service*/
        //---------------------------------------------------------------------------------------
    ) {
        $this->repository = new RepositoryCaller();
    }


    public function execute(): ResponseModel
    {

        // write your Logic code..
        $subscriptionCoach = $this->repository->CoachRepository()->readRepository()->getByTagWithSubsciption();

        $response  = new ShowSubscriptionOutput($subscriptionCoach
        , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Subscription)
        ,viewPath:'staf.show_subscription');

        return $response->send_as_object();
    }
}
