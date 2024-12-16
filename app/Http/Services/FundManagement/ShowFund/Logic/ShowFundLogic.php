<?php
namespace App\Http\Services\FundManagement\ShowFund\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowFundLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowFundInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $fundRepository = $this->repository->fundRepository();

        $funds = $fundRepository->readRepository()->find($this->input->getFundId());

        $response  = new ShowFundOutput($funds ,SuccessMessages::getKey(SuccessMessages::$show,Attributes::Fund)
        ,viewPath:'fund_management.show_fund');

        return $response->send_as_object();
   }
}
