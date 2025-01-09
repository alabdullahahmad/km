<?php
namespace App\Http\Repositories\BillLogRepositories;
use App\Models\BillLog;
use App\Http\Core\Repositories\UpdateRepository;

class BillLogUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new BillLog();
    }

}