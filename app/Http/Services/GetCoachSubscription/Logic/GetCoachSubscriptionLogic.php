<?php
namespace App\Http\Services\GetCoachSubscription\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\GetCoachSubscription\Logic\GetCoachSubscriptionOutput;

class GetCoachSubscriptionLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private GetCoachSubscriptionInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $coach = $this->repository->CoachRepository()->readRepository()->find($this->input->getCoachId());

        $subscriptions = json_decode($coach->class);

        $response  = $this->repository->SubscriptionRepository()->readRepository()->getMultiById($subscriptions);


        $response  = new GetCoachSubscriptionOutput($response ,
        SuccessMessages::getKey(SuccessMessages::$show,Attributes::Subscription));

        return $response->send_as_object();
   }
}
