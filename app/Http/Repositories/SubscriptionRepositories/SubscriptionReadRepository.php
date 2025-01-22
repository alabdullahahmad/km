<?php
namespace App\Http\Repositories\SubscriptionRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\Subscription;

class SubscriptionReadRepository extends ReadRepository
{

    public function __construct()
    {
        $this->model = new Subscription();
    }

    public function getAllWithRelations(array $condation ,$relastion = 'tag')
    {
        return $this->model->with($relastion)->where($condation)->get();
    }
    public function getOneWithRelations($id,array $condation,$relastion='tag')
    {
        return $this->model->with($relastion)->where($condation)->find($id);
    }

    public function getMultiById(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function getByTagId( $conditions , $lastSubscriptionPrice = null ) {
        if($lastSubscriptionPrice){
            $model = $this->model
            ->where($conditions)->where('price',">=",$lastSubscriptionPrice)->get();
            return $model;
        }
        $model = $this->model
        ->where($conditions)->get();
        return $model;
    }

}
