<?php
namespace App\Http\Repositories\branchRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\Branch;

class branchCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new Branch();
    }
}
