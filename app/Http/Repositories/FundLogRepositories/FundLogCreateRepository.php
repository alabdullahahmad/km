<?php
namespace App\Http\Repositories\FundLogRepositories;
use App\Models\FundLog;
use App\Http\Core\Repositories\CreateRepository;

class FundLogCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new FundLog();
    }
}
