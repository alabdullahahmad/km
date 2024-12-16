<?php
namespace App\Http\Services\DiscountsManagement\ShowDiscounts\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowDiscountsLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowDiscountsInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $discountRepository = $this->repository->DiscountsRepository();

        $discount = $discountRepository->readRepository()->find($this->input->getDiscountId());

        $response  = new ShowDiscountsOutput(
        $discount , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Discount)
        ,viewPath:'discounts_management.show_discounts'
        );
        return $response->send_as_object();
   }
}
