<?php
namespace App\Http\Services\BillManagement\AddBill\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use Illuminate\Support\Facades\DB;

class AddBillLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddBillInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..

        $bill = [];
        DB::transaction(function () use ($bill){

            $billRepository = $this->repository->BillRepository();
            if (!$this->input->userId) {

                $data = $this->input->toArray();
                $data['isCompletePayment'] = true;
                $bill = $billRepository->createRepository()->create($data);

                $this->repository->UserPaymentRepository()->createRepository()->create([
                    'billId' => $bill->id,
                    'amount' => $this->input->amount,
                    'stafId' => $this->input->stafId,
                    'date' => $this->input->date
                ]);

            }
            else {

                $data = $this->input->toArray();
                $data['isCompletePayment'] = ($this->input->amount == $this->input->price);

                $bill = $billRepository->createRepository()->create($this->input->toArray());

                $this->repository->UserPaymentRepository()->createRepository()->create([
                    'billId' => $bill->id,
                    'stafId' => $this->input->stafId,
                    'amount' => $this->input->amount,
                    'date' => $this->input->date
                ]);
            }


            $fund = $this->repository->fundRepository()->readRepository()->getFirstWithLock();

            $this->repository->fundRepository()->updateRepository()->update(
                [ 'branchId' => auth()->user()->branchId],
                [ 'amount' => ($this->input->payType == "in")?
                    $fund->amount + $this->input->amount
                    :$fund->amount - $this->input->amount
                ]
            );
        });



        $response  = new AddBillOutput($bill , SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Bill)
        ,viewPath:($this->input->userId)?'booking.index':'wallet.index'
        ,status:302);

        return $response->send_as_object();
   }
}
