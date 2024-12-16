<?php
namespace App\Http\Services\DiscountsManagement\EditeDiscounts\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class EditeDiscountsLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeDiscountsInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $discountRepository = $this->repository->DiscountsRepository();

        $discount = $discountRepository->updateRepository()->update(
            ['id' => $this->input->getDescountId()] ,
            $this->input->toArray()
        );

        $response  = new EditeDiscountsOutput($discount , SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Discount)
        ,viewPath:'discounts_management.edite_discounts');
        return $response->send_as_object();
   }
}
