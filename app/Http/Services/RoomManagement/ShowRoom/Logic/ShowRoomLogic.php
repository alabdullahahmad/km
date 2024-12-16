<?php
namespace App\Http\Services\RoomManagement\ShowRoom\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowRoomLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowRoomInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $roomRepository = $this->repository->RoomRepository();
        $room = $roomRepository->readRepository()->find($this->input->getRoomId());

        $response  = new ShowRoomOutput($room ,
        SuccessMessages::getKey(SuccessMessages::$show,Attributes::Room)
        ,viewPath:'room_management.show_room');
        return $response->send_as_array();
   }
}
