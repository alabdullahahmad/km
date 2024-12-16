<?php
namespace App\Http\Services\FundLogManagement\ShowFundLog\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ShowFundLogLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ShowFundLogInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your Logic code..

        $fundRepository = $this->repository->fundLogRepository();

        $fundLog = $fundRepository->readRepository()->getByConditions([
            'adminRecipient' => true,
            'stafRecipient' => true,
        ]);

        foreach ($fundLog as $value) {
            $value->staf;
        }
        
        $response  = new ShowFundLogOutput($fundLog ,
        SuccessMessages::getKey(SuccessMessages::$show,Attributes::FundLog),
        viewPath:'handyman.view',
        status:200);

        return $response->send_as_object();
   }
}
