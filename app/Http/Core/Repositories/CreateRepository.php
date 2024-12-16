<?php
namespace App\Http\Core\Repositories;

use App\Http\Core\Const\Messages\ErrorMessages;
use Illuminate\Database\Eloquent\Model;


abstract class CreateRepository {

    protected Model $model;


    public function create (array $data){
        $model = $this->model->query()->create(
            $data
        );
        return ($model)?$model:make_exception(ErrorMessages::getKey(ErrorMessages::$SomeThingWentWrong));
    }

}

