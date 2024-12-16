<?php
namespace App\Http\Services\StafManagement\EditeStaf\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class EditeStafLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories


    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeStafInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $coacheRepository = $this->repository->StafRepository();

        $coacheRepository->updateRepository()->update(
            ['id' => $this->input->getStafId()] ,
            $this->input->toArray()
        );
        $response  = new EditeStafOutput($coacheRepository,  SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Staf)
        ,viewPath:'provider.index'
        ,status:302
    );
        return $response->send_as_object();
   }
}
