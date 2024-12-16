<?php
namespace App\Http\Repositories\branchRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\Branch;

class branchUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new Branch();
    }

}
