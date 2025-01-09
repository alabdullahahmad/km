<?php
namespace App\Http\Services\ShowBillLog\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Services\ShowBillLog\Logic\ShowBillLogOutput;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowBillLogLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowBillLogInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller(); // init repository object
    }


    public function execute (): ResponseModel {

        // write your logic code..

        $billLog = $this->repository->BillLogRepository()->readRepository()
        ->getByConditions(['billId' => $this->input->getBillId()]);
        
        $response  = new ShowBillLogOutput($billLog ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Bill)
        ,viewPath:'provider.index'
        );

        return $response->send_as_object();
   }
}