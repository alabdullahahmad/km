<?php
namespace App\Http\Services\BillManagement\EditeBill\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use Illuminate\Support\Facades\DB;

class EditeBillLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeBillInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        $bill = [];
        DB::transaction(function () use ($bill) {

            $readBill = $this->repository->UserPaymentRepository()->readRepository()->getWithFirstBill($this->input->getBillId());

            $oldAmount = ($readBill->bill->payType == "in")? $readBill->amount : -$readBill->amount ;

            $billRepository = $this->repository->BillRepository();

            $bill = $billRepository->updateRepository()->update(
                ['id' => $this->input->getBillId()] ,
                $this->input->toArray()
            );

            $this->repository->UserPaymentRepository()->updateRepository()->update(
                ['id'=>$readBill->id],
                [
                    'amount' => $this->input->amount,
                    // 'date' => $this->input->date
                ]);

            $newAmount = ($this->input->payType == "in")? $this->input->amount : - $this->input->amount;


            $fund = $this->repository->fundRepository()->readRepository()->getFirstWithLock();

            $this->repository->fundRepository()->updateRepository()->update(
                [ 'branchId' => auth()->user()->branchId ],
                [
                     'amount' => ($fund->amount - $oldAmount) + $newAmount
                ]
            );
        });
        // write your logic code..

        $response  = new EditeBillOutput($bill , SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Bill)
        ,viewPath:'wallet.index'
        ,status:302);

        return $response->send_as_object();
   }
}
