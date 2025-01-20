<?php
namespace App\Http\Services\FundLogManagement\ViewFundLog\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ViewFundLogLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewFundLogInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..
        $fundRepository = $this->repository->fundLogRepository();

        $fundLog = $fundRepository->readRepository()->getAllRecordsWithRelations(
        conditions:[
            'adminRecipient' => false,
            'stafRecipient' => true,        
        ],
        relations:[
            "branch" => function ($q){
                return $q->select('id','name');
            }
        ]);

        foreach ($fundLog as $value) {
            $value->staf;
        }

        $response  = new ViewFundLogOutput($fundLog,
        SuccessMessages::getKey(SuccessMessages::$show,Attributes::FundLog)
        ,viewPath:'handyman.view');

        return $response->send_as_object();
   }
}
