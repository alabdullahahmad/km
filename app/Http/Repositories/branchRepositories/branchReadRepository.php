<?php
namespace App\Http\Repositories\branchRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\Branch;

class branchReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new Branch();
    }

}
