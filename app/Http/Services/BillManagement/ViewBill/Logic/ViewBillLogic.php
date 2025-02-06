<?php
namespace App\Http\Services\BillManagement\ViewBill\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewBillLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewBillInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        $condation = (auth()->user()->isAdmin) ? [] : ['branchId' => auth()->user()->branchId , 'stafId' => Auth::user()->id,'userId'=>null];

        // write your logic code..
        $billRepository = $this->repository->BillRepository();

        $bills = $billRepository->readRepository()->getAllRecordsWithRelations(
            ['userPayment'=>function($q){
                return $q->select('id','billId', DB::raw('SUM(amount) as totalAmount'))->groupBy('billId');
            },
            'branch' => function($q){
                return $q->select('id','name')->get();
            }
            ]
        ,$condation);

        foreach ($bills as  $value) {
            $value->staf = $this->repository->StafRepository()->readRepository()->find($value->stafId);
            $value->action =  view('wallet.action')->with(['wallet'=>$value])->render();

        }

        $response  = new ViewBillOutput($bills , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Bill)
        ,viewPath:'bill_management.show_bill');

        return $response->send_as_object();
   }
}
