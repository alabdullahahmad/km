<?php
namespace App\Http\Services\FundManagement\DeleteFund\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class DeleteFundLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteFundInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $fundRepository = $this->repository->fundRepository();

        $fund = $fundRepository->deleteRepository()->delete([
            'id' => $this->input->getFundId(),
        ]);

        $response  = new DeleteFundOutput($fund ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Fund)
        ,viewPath:'fund_management.delete_fund');

        return $response->send_as_object();
   }
}
