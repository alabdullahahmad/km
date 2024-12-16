<?php
namespace App\Http\Services\UserManagement\EditeUser\Logic;

use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;


class EditeUserLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeUserInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $userRepository = $this->repository->UserRepository();

        $user = $userRepository->readRepository()->find($this->input->getUserId());

        $userRepository->updateRepository()->update(
            ['id' => $this->input->getUserId()] ,
            $this->input->toArray($user)
        );

        $response  = new EditeUserOutput($user , SuccessMessages::getKey(SuccessMessages::$edit,Attributes::User)
        ,viewPath:'booking.index'
        ,status: 200);
        
        return $response->send_as_object();
   }
}
