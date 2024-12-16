<?php
namespace App\Http\Repositories\branchRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\Branch;

class branchDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new Branch();
    }
}
