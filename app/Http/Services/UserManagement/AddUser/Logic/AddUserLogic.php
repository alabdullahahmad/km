<?php
namespace App\Http\Services\UserManagement\AddUser\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class AddUserLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddUserInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $userRepository = $this->repository->UserRepository();

        $user = $userRepository->createRepository()->create($this->input->toArray());

        $response  = new AddUserOutput($user->id , SuccessMessages::getKey(SuccessMessages::$Add,Attributes::User)
        ,viewPath:'show.booking.page'
        ,status:302);
        
        return $response->send_as_object();
   }
}
