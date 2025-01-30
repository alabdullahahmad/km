<?php
namespace App\Http\Services\BranchManagement\BranchCalander\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class BranchCalanderLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private BranchCalanderInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $branchRepository = $this->repository->branchRepository();

        $branches = (auth()->user()->hasRole('admin'))?$branchRepository->readRepository()->getAllRecords()
        : $branchRepository->readRepository()->getByConditions(['id'=>auth()->user()->branchId]);


        $response  = new BranchCalanderOutput($branches , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Coache)
        ,viewPath:'branch_management.index_branch');
        return $response->send_as_object();
   }
}
