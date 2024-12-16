<?php
namespace App\Http\Services\Report\UserReportDetails\Logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class UserReportDetailsLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private UserReportDetailsInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $billReportRepository = $this->repository->BillRepository();
        $billReport = $billReportRepository->readRepository()->getBillReportForUser($this->input->userId);


        $response  = new UserReportDetailsOutput($billReport , 
        SuccessMessages::getKey(SuccessMessages::$show));
        return $response->send_as_object();
   }
}