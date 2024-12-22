<?php
namespace App\Http\Services\PlayerLoginLogManagement\ViewPlayerLoginLog\logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class ViewPlayerLoginLogLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private ViewPlayerLoginLogInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){}


    public function execute (): ResponseModel {

        // write your logic code..

        $response  = new ViewPlayerLoginLogOutput([] , '');
        return $response->send_as_array();
   }
}