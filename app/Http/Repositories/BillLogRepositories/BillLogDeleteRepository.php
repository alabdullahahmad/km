<?php
namespace App\Http\Repositories\BillLogRepositories;
use App\Models\BillLog;
use App\Http\Core\Repositories\DeleteRepository;

class BillLogDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new BillLog();
    }
}