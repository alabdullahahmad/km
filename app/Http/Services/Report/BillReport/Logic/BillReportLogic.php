<?php
namespace App\Http\Services\Report\BillReport\Logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class BillReportLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private BillReportInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $billReportRepository = $this->repository->BillRepository();
        $billReport = $billReportRepository->readRepository()->getBillReport($this->input->toArray());

        $response  = new BillReportOutput($billReport ,
        SuccessMessages::getKey(SuccessMessages::$show));
        
        return $response->send_as_object();
   }
}