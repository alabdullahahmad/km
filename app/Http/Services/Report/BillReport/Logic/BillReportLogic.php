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
        $billReport = $billReportRepository->readRepository()->getComplexReport($this->input->toArray());

        foreach ($billReport as  $value) {
            $value->action = view('service.user_service_action')->with(
                ['billId'=>$value->id]
            )->render();
        }

        $response  = new BillReportOutput($billReport ,
        SuccessMessages::getKey(SuccessMessages::$show));

        return $response->send_as_object();
   }
}
