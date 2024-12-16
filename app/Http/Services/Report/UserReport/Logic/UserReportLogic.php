<?php
namespace App\Http\Services\Report\UserReport\Logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class UserReportLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private UserReportInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $userReportRepository = $this->repository->UserRepository();
        $userReport = $userReportRepository->readRepository()->getUserReport($this->input->toArray());

        foreach ($userReport as  $value) {
            $value->action = view('bookingrating.action')->with(
                ['userId'=>$value->id]
            )->render();
        }
        $response  = new UserReportOutput($userReport ,
        SuccessMessages::getKey(SuccessMessages::$show));

        return $response->send_as_object();
   }
}
