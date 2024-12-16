<?php
namespace App\Http\Repositories\StafRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\Staf;

class StafDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new Staf();
    }
}