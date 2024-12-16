<?php
namespace App\Http\Repositories\FundLogRepositories;

use App\Http\Core\Repositories\ReadRepository;
use App\Models\FundLog;

class FundLogReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new FundLog();
    }

}
