<?php
namespace App\Http\Repositories\fundRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\fund;

class fundReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new fund();
    }

    public function getFirstWithLock($condation =[]){
        return  $this->model->query()->LockForUpdate()->where($condation)->first();
    }

}
