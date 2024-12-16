<?php
namespace App\Http\Services\FundManagement\EditeFund\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class EditeFundLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeFundInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $fundRepository = $this->repository->fundRepository();

        $fundRepository->updateRepository()->update(
            ['id' => $this->input->getFundId()] ,
            $this->input->toArray()
        );

        $response  = new EditeFundOutput([] ,  SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Fund)
        ,viewPath:'fund_management.edite_fund');
        return $response->send_as_object();
   }
}
