<?php
namespace App\Http\Services\FundLogManagement\EditeFundLog\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class EditeFundLogLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeFundLogInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $repository = $this->repository->fundLogRepository();
        $fundLog = $repository->updateRepository()->update(
            ['id' => $this->input->getFundLogId()],
            $this->input->toArray()
        );

        $response  = new EditeFundLogOutput($fundLog ,
        SuccessMessages::getKey(SuccessMessages::$edit,Attributes::FundLog)
        ,viewPath:'fundLogAdmin'
        ,status:302);
        return $response->send_as_object();
   }
}
