<?php
namespace App\Http\Services\RoomManagement\DeleteRoom\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class DeleteRoomLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteRoomInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $roomRepository = $this->repository->RoomRepository();

        $room = $roomRepository->deleteRepository()->delete(['id'=>$this->input->getRoomId()]);

        $response  = new DeleteRoomOutput($room ,
        SuccessMessages::getKey(SuccessMessages::$delete,Attributes::Room)
        ,viewPath:'slider.index');
        return $response->send_as_array();
   }
}
