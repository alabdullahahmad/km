<?php
namespace App\Http\Core\Repositories;

use App\Http\Core\Const\Messages\ErrorMessages;
use Illuminate\Database\Eloquent\Model;

abstract class UpdateRepository {

    protected Model $model;


    public function update ($conditions , array $data){
       $user = $this->model->query()->where($conditions)->update($data);
       return $user!=0 ? $user : make_exception(ErrorMessages::getKey(ErrorMessages::$SomeThingWentWrong));
    }
}

