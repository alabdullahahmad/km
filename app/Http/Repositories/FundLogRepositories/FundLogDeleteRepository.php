<?php
namespace App\Http\Repositories\FundLogRepositories;

use App\Http\Core\Repositories\DeleteRepository;
use App\Models\FundLog;

class FundLogDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new FundLog();
    }
}
