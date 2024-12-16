<?php
namespace App\Http\Core\Repositories;

use App\Http\Core\Const\Messages\ErrorMessages;
use Illuminate\Database\Eloquent\Model;

abstract class DeleteRepository {


    protected Model $model;


    public function delete (array $condations){
        $model = $this->model->query()->where(
            $condations
        )->delete();
        return ($model)?$model:make_exception(ErrorMessages::getKey(ErrorMessages::$SomeThingWentWrong));
    }

}
