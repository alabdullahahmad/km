<?php
namespace App\Http\Services\GetStafLogin\Logic;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Models\StafLoging;

class GetStafLoginLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private GetStafLoginInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller(); // init repository object
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $bill = StafLoging::query()->with('staf')->orderBy('updated_at','desc')->get();;

        $response  = new GetStafLoginOutput($bill, '');
        return $response->send_as_object();
   }
}
