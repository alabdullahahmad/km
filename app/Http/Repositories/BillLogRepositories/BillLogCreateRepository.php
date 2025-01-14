<?php
namespace App\Http\Repositories\BillLogRepositories;
use App\Models\BillLog;
use App\Http\Core\Repositories\CreateRepository;

class BillLogCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new BillLog();
    }
}