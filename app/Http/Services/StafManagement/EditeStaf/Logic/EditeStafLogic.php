<?php
namespace App\Http\Services\StafManagement\EditeStaf\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\ErrorMessages;
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

        if ($this->input->phoneNumber) {

            $staf = $this->repository->StafRepository()
            ->readRepository()->getByConditions([
                'phoneNumber' => $this->input->phoneNumber
            ]);

            if (count($staf)>0) {
                make_exception(ErrorMessages::getKey(ErrorMessages::$AccountAlreadyExists ,Attributes::Staf));
            }
        }


        $staf = $this->repository->StafRepository()
        ->readRepository()->find($this->input->getStafId());

        $coacheRepository->updateRepository()->update(
            ['id' => $this->input->getStafId()] ,
            $this->input->toArray($staf)
        );

        $response  = new EditeStafOutput($coacheRepository,  SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Staf)
        ,viewPath:'provider.index'
        ,status:302
    );
        return $response->send_as_object();
   }
}
