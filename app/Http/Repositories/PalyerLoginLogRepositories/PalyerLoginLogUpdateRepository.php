<?php
namespace App\Http\Repositories\PalyerLoginLogRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\PalyerLoginLog;

class PalyerLoginLogUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new PalyerLoginLog();
    }

}