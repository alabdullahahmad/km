<?php
namespace App\Http\Services\SubscriptionManagement\AddSubscription\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\SubscriptionManagement\AddSubscription\Logic\AddSubscriptionOutput;

class AddSubscriptionLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories


    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddSubscriptionInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $subscriptionRepository = $this->repository->SubscriptionRepository();

        $subscription = $subscriptionRepository->createRepository()->create($this->input->toArray());

        $response  = new AddSubscriptionOutput($subscription ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Subscription)
        ,viewPath:'service.index.id'
        ,status : 422
    );
        return $response->send_as_object();
   }
}
