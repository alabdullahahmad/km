<?php
namespace App\Http\Services\StafManagement\DeleteStaf\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Http\Services\StafManagement\DeleteStaf\Logic\DeleteStafOutput;

class DeleteStafLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteStafInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        // write your logic code..
        $stafRepository = $this->repository->StafRepository();

        $staf = $stafRepository->deleteRepository()->delete(
            ['id' => $this->input->getStafId()],
        );


        $response  = new DeleteStafOutput($staf ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Staf)
      );
        return $response->send_as_object();
   }
}
