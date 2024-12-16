<?php
namespace App\Http\Services\RoomManagement\EditeRoom\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\RoomManagement\EditeRoom\Logic\EditeRoomOutput;

class EditeRoomLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeRoomInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $repository = $this->repository->RoomRepository();
        $room = $repository->updateRepository()->update(
            ['id'=>$this->input->getRoomId()],
            $this->input->toArray()
        );
        $response  = new EditeRoomOutput($room ,
        SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Room)
        ,viewPath:'slider.index'
        ,status:302);
        return $response->send_as_object();
   }
}
