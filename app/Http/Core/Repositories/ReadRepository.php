<?php
namespace App\Http\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class ReadRepository
{
    protected Model $model;

    public function find(int $id , array $selected = ["*"]){
        return $this->model->select($selected)->find($id);
    }

    public function is_exists($conditions , array $selected = ["*"]){
       return $this->model::select($selected)
                ->where($conditions)
                ->exists();
    }

    public function getByConditions( $conditions , array $selected = ["*"] ) {
        $model = $this->model->select($selected)
        ->where($conditions)->get();
        return $model;
    }

    public function getFirstByConditions( $conditions , array $selected = ["*"] ) {
        $model = $this->model->select($selected)
        ->where($conditions)->first();
        return $model;
    }

    public function getByValue($column , $value):Model | null {
        $model = $this->model->where($column , $value)->first();
        return $model;
    }

    public function getAllRecords(){
        return $model = $this->model->query()->get();
    }

    public function getAllRecordsWithRelations(array $relations,$conditions){
        return $model = $this->model->query()->with($relations)->where($conditions)->get();
    }


    public function getAllUser(){
        return $this->model->query()->orderBy('created_at',"DESC")->get();
    }



}
