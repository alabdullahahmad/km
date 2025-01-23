<?php
namespace App\Http\Services\BillManagement\DeleteBill\Logic;

use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class DeleteBillLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories


    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteBillInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $billRepository = $this->repository->BillRepository();

        $bill = $billRepository->deleteRepository()->delete(['id'=>$this->input->getBillId()]);

        $response  = new DeleteBillOutput($bill ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Bill)
        ,viewPath:'bill.index',status:302);
        return $response->send_as_object();
   }
}
