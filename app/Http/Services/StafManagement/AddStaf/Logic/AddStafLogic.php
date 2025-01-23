<?php
namespace App\Http\Services\StafManagement\AddStaf\Logic;

use App\Http\Core\Const\Messages\Attributes;
use App\Http\Core\Const\Messages\SuccessMessages;
use App\Http\Repositories\RepositoryCaller;
use App\Http\Core\InternalInterface\Service;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use App\Models\Role;

class AddStafLogic implements Service {

    private RepositoryCaller $repository ; // access to all model's repositories

    public function __construct(
    //---------------------------------------------------------------------------------------
    private AddStafInput $input,  /*| Pass Request To Service*/
    //---------------------------------------------------------------------------------------
    ){
        $this->repository = new RepositoryCaller();
    }


    public function execute (): ResponseModel {

        // write your logic code..
        $stafRepository = $this->repository->StafRepository();

        $staf = $stafRepository->createRepository()->create($this->input->toArray());

        $role = Role::query()->find($this->input->roleId);

        $staf->assignRole($role->name);

        if ($role->name == "admin") {
            $staf->isAdmin = true;
            $staf->save();
        }
        
        $response  = new AddStafOutput($staf ,
        SuccessMessages::getKey(SuccessMessages::$Add,Attributes::Staf)
        ,viewPath:'provider.index',status:302
        );
        return $response->send_as_object();
   }
}
