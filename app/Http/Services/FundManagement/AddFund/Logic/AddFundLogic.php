<?php
namespace App\Http\Services\FundManagement\AddFund\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class AddFundLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddFundInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $fundRepository = $this->repository->fundRepository();

        $fund = $fundRepository->createRepository()->create($this->input->toArray());

        $response  = new AddFundOutput($fund ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Fund)
        ,viewPath:'fund_management.add_fund');
        return $response->send_as_object();
   }
}
