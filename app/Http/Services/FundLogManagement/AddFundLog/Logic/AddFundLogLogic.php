<?php
namespace App\Http\Services\FundLogManagement\AddFundLog\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use Illuminate\Support\Facades\Auth;

class AddFundLogLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddFundLogInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $fundLogRepository = $this->repository->FundLogRepository();

        $fund = $fundLogRepository->createRepository()->create($this->input->toArray());

        $this->repository->fundRepository()->updateRepository()->update(
            [ 'branchId' => auth()->user()->branchId],
            ['amount' => 0 ],
        );

        // Auth::logout();

        $response  = new AddFundLogOutput($fund ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::FundLog
        ),viewPath:'home',status:302);

        return $response->send_as_object();
   }
}
