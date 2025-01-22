<?php
namespace App\Http\Services\EditBillDate\Logic;

use Illuminate\Support\Facades\DB;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class EditBillDateLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditBillDateInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        $bill = [];

        DB::transaction(function () use ($bill){

            $billRepository = $this->repository->BillRepository();

            $billBefor = $billRepository->readRepository()->find($this->input->getBillId());

            $data = $this->input->toArray();
            $data['endDate'] = $this->input->getEndDate($billBefor->subscription->numofDays,$data['startDate']);

            $bill = $billRepository->updateRepository()->update(
                ['id' => $this->input->getBillId()] ,
                $data
            );

            $this->repository->BillLogRepository()
            ->createRepository()->create([
                'billId' => $billBefor->id,
                'stafId' => auth()->id(),
                'subscriptionDateModified' =>true,
                'startDateAfterEdit' => $this->input->startDate,

            ]);
            
        });
        // write your logic code..

        $response  = new EditBillDateOutput($bill , SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Bill)
        ,viewPath:'booking.index'
        ,status:302);

        return $response->send_as_object();
   }
}
