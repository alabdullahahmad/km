<?php
namespace App\Http\Services\PlayerLoginLogManagement\AddPlayerLoginLog\Logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class AddPlayerLoginLogLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddPlayerLoginLogInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $playerLoginLog = $this->repository->PalyerLoginLogRepository()->createRepository()
        ->create($this->input->toArray());

        $response  = new AddPlayerLoginLogOutput(['success'=>true] , 
        SuccessMessages::getKey(SuccessMessages::$Add));

        return $response->send_as_object();
   }
}