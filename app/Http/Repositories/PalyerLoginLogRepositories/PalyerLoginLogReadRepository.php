<?php
namespace App\Http\Repositories\PalyerLoginLogRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\PalyerLoginLog;

class PalyerLoginLogReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new PalyerLoginLog();
    }

}