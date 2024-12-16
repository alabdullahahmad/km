<?php
namespace App\Http\Services\SubscriptionManagement\EditeSubscription\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\SubscriptionManagement\EditeSubscription\Logic\EditeSubscriptionOutput;

class EditeSubscriptionLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeSubscriptionInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $subscriptionRepository = $this->repository->SubscriptionRepository();

        $subscription = $subscriptionRepository->updateRepository()->update(
            ['id' => $this->input->getSubscriptionId()],
            $this->input->toArray()
        );

        $response  = new EditeSubscriptionOutput($subscription , SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Subscription)
        ,viewPath:'service.index',
        status:422);
        
        return $response->send_as_object();
   }
}
