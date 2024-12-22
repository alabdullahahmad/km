<?php
namespace App\Http\Services\ChangeAdminStatus\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ChangeAdminStatusLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ChangeAdminStatusInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $staf = $this->repository->StafRepository()
        ->updateRepository()->update(
            ['id'=>$this->input->stafId],[
            'isAdmin' => $this->input->isAdmin
        ]);

        $staf = $this->repository->StafRepository()->readRepository()
        ->find($this->input->stafId);

        if ($this->input->isAdmin) {
            $staf->assignRole('admin');
        }
        else{
            $staf->removeRole('admin');
        }


        $response  = new ChangeAdminStatusOutput([] ,
        SuccessMessages::getKey(SuccessMessages::$show,Attributes::Staf));

        return $response->send_as_object();
   }
}
