<?php
namespace App\Http\Services\ShowAllUser\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Services\ShowAllUser\Logic\ShowAllUserOutput;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowAllUserLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowAllUserInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){}


    public function execute (): ResponseModel {

        // write your logic code..
        $userRepository = $this->repository->UserRepository();

        $users = $userRepository->readRepository()->getAllUser();

        // foreach ($users as $user) {
        //     $user->action =  view('handymanrating.action')->with(['bill'=>$user])->render();
        // }

        $response  = new ShowAllUserOutput($users , SuccessMessages::getKey(SuccessMessages::$show,Attributes::User)
        ,viewPath:'user_management.show_user');

        return $response->send_as_object();
   }
}
