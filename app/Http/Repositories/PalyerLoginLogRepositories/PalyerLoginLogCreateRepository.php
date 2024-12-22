<?php
namespace App\Http\Repositories\PalyerLoginLogRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\PalyerLoginLog;

class PalyerLoginLogCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new PalyerLoginLog();
    }
}