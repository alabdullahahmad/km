<?php
namespace App\Http\Repositories\fundRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\fund;

class fundUpdateRepository extends UpdateRepository
{

    public function __construct()
    {
        $this->model = new fund();
    }

    public function updateFirst(array $data){
        return $this->model::query()->update($data);
    }

}
