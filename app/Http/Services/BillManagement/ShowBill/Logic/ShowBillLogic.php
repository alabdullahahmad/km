<?php
namespace App\Http\Services\BillManagement\ShowBill\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowBillLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowBillInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $billRepository = $this->repository->BillRepository();

        $condation = (auth()->user()->isAdmin) ? [] : ['branchId' => auth()->user()->branchId];
        $bills = $billRepository->readRepository()->getUsersBill($condation);

        foreach ($bills as $bill) {
            $bill->action  = view('booking.action')->with(['booking'=>$bill])->render();
        }

        $response  = new ShowBillOutput($bills , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Bill)
        ,viewPath:'bill_management.show_bill'
        );
        return $response->send_as_object();
   }
}
