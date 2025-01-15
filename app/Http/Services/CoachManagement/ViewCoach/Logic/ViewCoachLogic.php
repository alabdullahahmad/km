<?php
namespace App\Http\Services\CoachManagement\ViewCoach\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ViewCoachLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewCoachInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $coacheRepository = $this->repository->CoachRepository();

        $coaches = $coacheRepository->readRepository()->getAllRecordsWithRelations([
            'branch' => function($q){
                return $q->select('id','name');
            }
        ]);
        
        foreach ($coaches as $value) {
            $value->category;
            $value->action =  view('handyman.action')->with(['handyman'=>$value])->render();
        }
        $response  = new ViewCoachOutput($coaches ,  SuccessMessages::getKey(SuccessMessages::$show,Attributes::Coache)
        ,viewPath:'coache_management.index_coache');
        return $response->send_as_object();
   }
}
