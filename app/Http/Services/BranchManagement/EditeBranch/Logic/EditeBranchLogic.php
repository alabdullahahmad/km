<?php
namespace App\Http\Services\BranchManagement\EditeBranch\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class EditeBranchLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private EditeBranchInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $branchRepository = $this->repository->branchRepository();

        $branchRepository->updateRepository()->update(
            ['id' => $this->input->getBranchId()] ,
            $this->input->toArray()
        );

        $response  = new EditeBranchOutput([] , SuccessMessages::getKey(SuccessMessages::$edit,Attributes::Branch)
        ,viewPath:'coupon.index',
        status : 302);
        return $response->send_as_array();
   }
}
