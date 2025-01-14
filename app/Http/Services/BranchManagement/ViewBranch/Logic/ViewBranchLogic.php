<?php
namespace App\Http\Services\BranchManagement\ViewBranch\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ViewBranchLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewBranchInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $branchRepository = $this->repository->branchRepository();

        $branches = $branchRepository->readRepository()->getAllRecords();

        foreach ($branches as $value) {
            $value->action =  view('coupon.action')->with(['coupon'=>$value])->render();
        }

        $response  = new ViewBranchOutput($branches , SuccessMessages::getKey(SuccessMessages::$show,Attributes::Coache)
        ,viewPath:'branch_management.index_branch');
        return $response->send_as_object();
   }
}
