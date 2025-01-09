<?php
namespace App\Http\Repositories\BillLogRepositories;

use App\Http\Core\Repositories\ReadRepository;
use App\Models\BillLog;

class BillLogReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new BillLog();
    }

}