<?php
namespace App\Http\Services\SubscriptionManagement\DeleteSubscription\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\SubscriptionManagement\DeleteSubscription\Logic\DeleteSubscriptionOutput;

class DeleteSubscriptionLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteSubscriptionInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $subscriptionRepository = $this->repository->SubscriptionRepository();

        $subscription = $subscriptionRepository->deleteRepository()->delete(
            ['id' => $this->input->getSubscriptionId()]
        );

        $response  = new DeleteSubscriptionOutput($subscription , SuccessMessages::getKey(SuccessMessages::$delete,Attributes::Subscription),
        viewPath:'subscription_management.delete_subscription');
        return $response->send_as_array();
   }
}
