<?php
namespace App\Http\Services\PlayerLoginLogManagement\ShowPlayerLoginLog\logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowPlayerLoginLogLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowPlayerLoginLogInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $playerLoginLog = $this->repository->PalyerLoginLogRepository()
        ->readRepository()->getByConditions([
            'userId' => $this->input->getUserId()
        ]);

        $response  = new ShowPlayerLoginLogOutput(
        $playerLoginLog , 
        SuccessMessages::getKey(SuccessMessages::$show)
        );
        return $response->send_as_object();
   }
}