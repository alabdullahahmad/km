<?php
namespace App\Http\Repositories\FundLogRepositories;

use App\Http\Core\Repositories\UpdateRepository;
use App\Models\FundLog;

class FundLogUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new FundLog();
    }

}
