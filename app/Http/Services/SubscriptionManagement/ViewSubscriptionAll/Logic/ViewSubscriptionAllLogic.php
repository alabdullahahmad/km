<?php
namespace App\Http\services\SubscriptionManagement\ViewSubscriptionAll\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\SubscriptionManagement\ViewSubscription\Logic\ViewSubscriptionOutput;

class ViewSubscriptionAllLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewSubscriptionAllInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $subscriptionRepository = $this->repository->SubscriptionRepository();

        $subscriptions = $subscriptionRepository->readRepository()->getAllRecords();


        $response  = new ViewSubscriptionOutput($subscriptions , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Subscription)
        ,viewPath:'service.index');
        return $response->send_as_object();
   }
}
