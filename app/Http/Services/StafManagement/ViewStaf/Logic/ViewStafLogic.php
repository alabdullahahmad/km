<?php
namespace App\Http\Services\StafManagement\ViewStaf\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ViewStafLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewStafInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $stafRepository = $this->repository->StafRepository();

        $stafs = $stafRepository->readRepository()->getAllRecordsWithRelations([
            'branch' => function($q){
                return $q->select('id','name');
            },
            'roles'
        ]);
        foreach ($stafs as $value) {
            $value->category;
            $value->action =  view('provider.action')->with(['provider'=>$value])->render();
        }

        $response  = new ViewStafOutput($stafs, SuccessMessages::getKey(SuccessMessages::$show,Attributes::Staf)
        ,viewPath:'staf_management.show_staf');

        return $response->send_as_object();
   }
}
