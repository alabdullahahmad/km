<?php
namespace App\Http\Services\UserManagement\ShowUser\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowUserLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowUserInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $userRepository = $this->repository->UserRepository();

        $user = $userRepository->readRepository()->find($this->input->getUserId());

        $bills = $this->repository->BillRepository()
        ->readRepository()->getBillUsers($this->input->getUserId());

        $response  = new ShowUserOutput([
            "user" => $user,
            "bills" => $bills
        ], SuccessMessages::getKey(SuccessMessages::$show,Attributes::User)
        ,viewPath:'setting.help_support_form');

        return $response->send_as_object();
   }
}
