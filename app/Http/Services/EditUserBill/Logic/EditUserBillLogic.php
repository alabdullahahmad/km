<?php
namespace App\Http\Services\BillManagement\EditUserBill\Logic;

use Illuminate\Support\Facades\DB;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class EditUserBillLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditUserBillInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        $bill = [];

        DB::transaction(function () use ($bill){

            $billRepository = $this->repository->BillRepository();

            $billBefor = $billRepository->readRepository()->find($this->input->getBillId());

            $bill = $billRepository->updateRepository()->update(
                ['id' => $this->input->getBillId()] ,
                $this->input->toArray()
            );

            $this->repository->BillLogRepository()
            ->createRepository()->create([
                'stafId' => auth()->id(),
                'isTypeModified' => true,
                'subscriptionBeforeEdit' => $billBefor->subscriptionId,
                'subscriptionAfterEdit' => $this->input->subscriptionId
            ]);
            
        });
        // write your logic code..

        $response  = new EditUserBillOutput($bill , SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Bill)
        ,viewPath:'wallet.index'
        ,status:302);

        return $response->send_as_object();
   }
}
