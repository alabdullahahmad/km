<?php
namespace App\Http\services\SubscriptionManagement\ViewSubscription\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\SubscriptionManagement\ViewSubscription\Logic\ViewSubscriptionOutput;

class ViewSubscriptionLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewSubscriptionInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $subscriptionRepository = $this->repository->SubscriptionRepository();

        $subscriptions = $subscriptionRepository->readRepository()->getAllRecordsWithRelations([
            'branch'
        ],[
            'categoryId' => $this->input->categoryId
        ]);

        foreach ($subscriptions as $value) {
            $value->tag = $this->repository->TagRepository()->readRepository()->find($value->tagId);
            $value->action =  view('service.action')->with(['data'=>$value])->render();
        }

        $response  = new ViewSubscriptionOutput($subscriptions , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Subscription)
        ,viewPath:'service.index');
        return $response->send_as_object();
   }
}
