<?php
namespace App\Http\Services\PlayerLoginLogManagement\DeletePlayerLoginLog\logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class DeletePlayerLoginLogLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private DeletePlayerLoginLogInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){}


    public function execute (): ResponseModel {

        // write your logic code..

        $response  = new DeletePlayerLoginLogOutput([] , '');
        return $response->send_as_array();
   }
}