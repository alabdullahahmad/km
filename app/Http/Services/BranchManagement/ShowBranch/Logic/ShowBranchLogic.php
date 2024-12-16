<?php
namespace App\Http\Services\BranchManagement\ShowBranch\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowBranchLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowBranchInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $branchRepository = $this->repository->branchRepository();

        $branch = $branchRepository->readRepository()->find($this->input->getBranchId());

        $response  = new ShowBranchOutput($branch , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Branch)
        ,viewPath:'branch_management.show_branch');
        return $response->send_as_object();
   }
}
