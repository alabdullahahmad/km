<?php
namespace App\Http\Services\Report\ComplexReport\Logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ComplexReportLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ComplexReportInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $userReportRepository = $this->repository->BillRepository();
        $userReport = $userReportRepository->readRepository()->getComplexReport($this->input->toArray());

        foreach ($userReport as  $value) {
            $value->action = view('bookingrating.action')->with(
                ['userId'=>$value->id]
            )->render();
        }
        $response  = new ComplexReportOutput($userReport ,
        SuccessMessages::getKey(SuccessMessages::$show));

        return $response->send_as_object();
   }
}
