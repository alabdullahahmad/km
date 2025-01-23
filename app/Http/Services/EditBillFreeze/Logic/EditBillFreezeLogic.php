<?php
namespace App\Http\Services\EditBillFreeze\Logic;

use Illuminate\Support\Facades\DB;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class EditBillFreezeLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditBillFreezeInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        $bill = [];

            $billRepository = $this->repository->BillRepository();

            $billBefor = $billRepository->readRepository()->find($this->input->getBillId());

            $data = $this->input->toArray();
            $data['endDate'] = $this->input->getEndDate($billBefor->endDate);

            $bill = $billRepository->updateRepository()->update(
                ['id' => $this->input->getBillId()] ,
                $data
            );

            
        // write your logic code..

        $response  = new EditBillFreezeOutput($bill , SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Bill)
        ,viewPath:'booking.index'
        ,status:302);

        return $response->send_as_object();
   }
}
