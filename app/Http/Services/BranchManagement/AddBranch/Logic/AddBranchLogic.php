<?php
namespace App\Http\Services\BranchManagement\AddBranch\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class AddBranchLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddBranchInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $branchRepository = $this->repository->branchRepository();

        $branch = $branchRepository->createRepository()->create($this->input->toArray());

        $response  = new AddBranchOutput($branch ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Branch)
        ,viewPath:'coupon.index',
        status : 302
        );
        return $response->send_as_object();
   }
}
