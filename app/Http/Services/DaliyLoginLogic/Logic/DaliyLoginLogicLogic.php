<?php
namespace App\Http\Services\DaliyLoginLogic\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class DaliyLoginLogicLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DaliyLoginLogicInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller(); // init repository object
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $bill = [];
        $billRepository = $this->repository->BillRepository();

        $billRepository->updateRepository()->updateWithDdate();

        $bill = $billRepository->readRepository()->checkLoginUser($this->input->userId);

        $user = $this->repository->UserRepository()->readRepository()->find($this->input->userId);
        $user->loginDate = date('Y-m-d H:i');

        $billCount = count($bill);

        if ($billCount == 0) {

            $bill [] = $billRepository->readRepository()->endBill($this->input->userId);
            if ($bill->first()) {
                $bill->first()->status = 1;
                $this->repository->PalyerLoginLogRepository()->createRepository()
                ->create([
                    'date'=> date("Y-m-d H:i"),
                    'userId' => $this->input->userId,
                    'subscriptionName' => $bill->first()->subscription->name,
                    'loginFiled' => false
                ]);
            }
            $user->status = 1;
        }


        if ($billCount == 1) {
            $this->repository->PalyerLoginLogRepository()->createRepository()
            ->create([
                'date'=> date("Y-m-d H:i"),
                'userId' => $this->input->userId,
                'subscriptionName' => $bill->subscription->name,
            ]);
        }


        $response  = new DaliyLoginLogicOutput([
            'bill'=>$bill,
            'user'=>$user
        ] , '');
        return $response->send_as_object();
   }
}
