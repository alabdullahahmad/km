<?php
namespace App\Http\Services\UserManagement\ViewUser\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ViewUserLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewUserInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $userRepository = $this->repository->BillRepository();

        $users = $userRepository->readRepository()->getUsersDues();

        // foreach ($users as $user) {
        //     $user->action =  view('handymanrating.action')->with(['bill'=>$user])->render();
        // }
        $response  = new ViewUserOutput($users , SuccessMessages::getKey(SuccessMessages::$show,Attributes::User)
        ,viewPath:'user_management.show_user');

        return $response->send_as_object();
   }
}
