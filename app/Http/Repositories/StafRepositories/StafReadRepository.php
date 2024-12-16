<?php
namespace App\Http\Repositories\StafRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\Staf;

class StafReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new Staf();
    }

}