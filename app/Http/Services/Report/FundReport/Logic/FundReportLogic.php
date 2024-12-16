<?php
namespace App\Http\Services\Report\FundReport\Logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class FundReportLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private FundReportInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $fundReportRepository = $this->repository->BillRepository();

        $fundRepot = $fundReportRepository->readRepository()->getGroupByForFund(
            $this->input->toArray()
        );

        foreach ($fundRepot as  $value) {
            info($value->date);
            $value->action = view('postrequest.action')->with(['date'=>$value->date,])->render();
        }

        $response  = new FundReportOutput($fundRepot ,
        SuccessMessages::getKey(SuccessMessages::$show),);

        return $response->send_as_object();
   }
}
