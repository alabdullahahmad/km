<?php

namespace App\Http\Services\PlayerLoginLogManagement\AddPlayerLoginLog\Logic;

use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use DateTime;
use PDO;

class AddPlayerLoginLogLogic implements Service
{

    private RepositoryCaller $repository; // access to all model's repositories

    public function __construct(
        //---------------------------------------------------------------------------------------
        private AddPlayerLoginLogInput $input,  /*| Pass Request To Service*/
        //---------------------------------------------------------------------------------------
    ) {
        $this->repository = new RepositoryCaller();
    }


    public function execute(): ResponseModel
    {

        // write your logic code..
        $bill = $this->repository->BillRepository()->readRepository()->find($this->input->getBillId());

        $currentdate = new DateTime();
        $endDate = new DateTime($bill->endDate);

        if ($currentdate > $endDate) {
            $bill->isEnd = true;
            $bill->save();
            make_exception(__('messages.isEnd'));
        }

        if ($bill->startDateFreeze && $bill->endDateFreeze) {

            $startFreezeDate = new DateTime($bill->startDateFreeze);
            $endFreezeDate = new DateTime($bill->endDateFreeze);

            if ($currentdate >= $startFreezeDate || $currentdate <= $endFreezeDate) {
                make_exception(__('messages.isFreeze'));
            }
        }



        $playerLoginLog = $this->repository->PalyerLoginLogRepository()->createRepository()
            ->create($this->input->toArray());

        $response  = new AddPlayerLoginLogOutput(
            ['success' => true],
            SuccessMessages::getKey(SuccessMessages::$Add)
        );

        return $response->send_as_object();
    }
}
