<?php
namespace App\Http\Services\DiscountsManagement\ViewDiscounts\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ViewDiscountsLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewDiscountsInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $discountRepository = $this->repository->DiscountsRepository();

        $discounts = $discountRepository->readRepository()->getAllRecords();

        $response  = new ViewDiscountsOutput($discounts , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Discount)
        ,viewPath:'discounts_management.index_discounts');
        return $response->send_as_object();
   }
}
