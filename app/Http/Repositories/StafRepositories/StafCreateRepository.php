<?php
namespace App\Http\Repositories\StafRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\Staf;

class StafCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new Staf();
    }
}