<?php
namespace App\Http\Repositories\UserRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\User;

class UserReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new User();
    }


    public function getUserReport(array $data = null , $condation = []){
        $model = $this->model->query()->withCount('bills');

        if ($data) {
            $model = $model->whereBetween('created_at', $data);
        }

        return $model->where($condation)->get();
    }
}
