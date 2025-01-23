<?php
namespace App\Http\Services\PlayerLoginLogManagement\AddPlayerLoginLog\Logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use DateTime;
use PDO;

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
        $bill = $this->repository->BillRepository()->readRepository()->find($this->input->getBillId());

        $currentdate = date('Y-m-d');
        $endDate = new DateTime($bill->endDate);
        $startFreezeDate = new DateTime($bill->startDateFreeze);
        $endFreezeDate = new DateTime($bill->endDateFreeze);

        if($currentdate >= $startFreezeDate || $currentdate <= $endFreezeDate){
            make_exception('isFreeze');
        }

        if($currentdate > $endDate){
            $bill->isEnd = true;
            $bill->save();
            make_exception('isEnd');
        }

        $playerLoginLog = $this->repository->PalyerLoginLogRepository()->createRepository()
        ->create($this->input->toArray());

        $response  = new AddPlayerLoginLogOutput(['success'=>true] , 
        SuccessMessages::getKey(SuccessMessages::$Add));

        return $response->send_as_object();
   }
}