<?php
namespace App\Http\Services\CompletePaymenet\Logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class CompletePaymenetLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private CompletePaymenetInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $billRepositeries = $this->repository->UserPaymentRepository();
        $billPaymenet = $billRepositeries->createRepository()->create(
            $this->input->toArray()
        );

        $bill = $this->repository->BillRepository()->readRepository()
        ->getBillPaymenet($this->input->billId);
        
        if ($bill->totalAmount == $billPaymenet->price) {
            $bill->isCompletePayment == true;
            $bill->save();
        }

        $response  = new CompletePaymenetOutput($bill->toArray() , 
        SuccessMessages::getKey(SuccessMessages::$show)
        ,viewPath:'booking.index',status:200);

        return $response->send_as_object();
   }
}