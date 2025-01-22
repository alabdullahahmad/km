<?php
namespace App\Http\Services\SubscriptionManagement\ShowSubscription\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\SubscriptionManagement\ShowSubscription\Logic\ShowSubscriptionOutput;

class ShowSubscriptionLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowSubscriptionInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..

        $lastSubscriptionPrice = null;
        if ($this->input->billId) {
            $lastSubscriptionPrice  = $this->repository
            ->BillRepository()->readRepository()->find($this->input->billId)
            ->subscription->price;
        }
        
        $subscritptionRepository = $this->repository->SubscriptionRepository();
        $subscritption = $subscritptionRepository->readRepository()->getByTagId(
            ['tagId' => $this->input->getTagId()] , $lastSubscriptionPrice
        );

        $response  = new ShowSubscriptionOutput($subscritption , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Subscription)
        ,viewPath:'subscription_management.show_subscription');
        
        return $response->send_as_object();
   }
}
