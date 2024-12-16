<?php
namespace App\Http\Services\DiscountsManagement\DeleteDiscounts\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use GrahamCampbell\ResultType\Success;

class DeleteDiscountsLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteDiscountsInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $discountRepository = $this->repository->DiscountsRepository();

        $discount = $discountRepository->deleteRepository()->delete([
            'id' => $this->input->getDiscountId(),
        ]);

        $response  = new DeleteDiscountsOutput($discount , SuccessMessages::getKey(SuccessMessages::$delete,Attributes::Discount)
        ,viewPath:'discounts_management.delete_discounts'
        );
        return $response->send_as_object();
   }
}
