<?php
namespace App\Http\Services\RoomManagement\ViewRoom\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\RoomManagement\ViewRoom\Logic\ViewRoomOutput;

class ViewRoomLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewRoomInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $roomRepository = $this->repository->RoomRepository();
        $rooms = $roomRepository->readRepository()->getAllRecordsWithRelations([
            'branch' => function($q){
                return $q->select('id','name');
            }
        ]);

        foreach ($rooms as $value) {
            $value->category;
            $value->action =  view('slider.action')->with(['slider'=>$value])->render();
        }
        $response  = new ViewRoomOutput($rooms ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Room)
        ,viewPath:'slider.index');
        return $response->send_as_object();
   }
}
