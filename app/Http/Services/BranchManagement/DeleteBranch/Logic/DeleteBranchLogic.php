<?php
namespace App\Http\Services\BranchManagement\DeleteBranch\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class DeleteBranchLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeleteBranchInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $branchRepository = $this->repository->branchRepository();

        $branch = $branchRepository->deleteRepository()->delete([
            'id' => $this->input->getBranchId(),
        ]);

        $response  = new DeleteBranchOutput($branch , SuccessMessages::getKey(SuccessMessages::$delete,Attributes::Branch)
        ,viewPath:'branch_management.delete_branch');

        return $response->send_as_object();
   }
}
