<?php
namespace App\Http\Services\DiscountsManagement\AddDiscounts\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class AddDiscountsLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddDiscountsInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $discountRepository = $this->repository->DiscountsRepository();

        $discount = $discountRepository->createRepository()->create($this->input->toArray());

        $response  = new AddDiscountsOutput(
            $discount , SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Discount)
            ,viewPath:'discounts_management.add_discounts'
        );
        return $response->send_as_object();
   }
}
