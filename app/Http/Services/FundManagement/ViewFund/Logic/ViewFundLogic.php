<?php
namespace App\Http\Services\FundManagement\ViewFund\Logic;

use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\FundManagement\ShowFund\Logic\ShowFundOutput;

class ViewFundLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewFundInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        $fundRepository = $this->repository->fundRepository();

        $funds = $fundRepository->readRepository()->getAllRecords();

        $response  = new ShowFundOutput($funds ,SuccessMessages::getKey(SuccessMessages::$show,Attributes::Fund)
        ,viewPath:'fund_management.show_fund');

        return $response->send_as_object();
   }
}
