<?php
namespace App\Http\Services\Report\ClassReport\Logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ClassReportLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ClassReportInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $calssReportRepository = $this->repository->BillRepository();

        $calssRepot = $calssReportRepository->readRepository()->getGroupByForClass(
            $this->input->toArray()
        );

        foreach ($calssRepot as  $value) {
            $value->action = view('payment.action')->with([
                'coachId' => $value->coachId,
                'subscriptionId' => $value->subscriptionId
            ])->render();
        }
        $response  = new ClassReportOutput($calssRepot , 
        SuccessMessages::getKey(SuccessMessages::$show));
        return $response->send_as_object();
   }
}