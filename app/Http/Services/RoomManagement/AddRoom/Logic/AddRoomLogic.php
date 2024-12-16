<?php
namespace App\Http\Services\RoomManagement\AddRoom\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class AddRoomLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddRoomInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        $roomRepository = $this->repository->RoomRepository();

        $room = $roomRepository->createRepository()->create($this->input->toArray());


        $response  = new AddRoomOutput($room ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Room)
        ,viewPath:'slider.index',
        status:302
        );

        return $response->send_as_object();
   }
}
