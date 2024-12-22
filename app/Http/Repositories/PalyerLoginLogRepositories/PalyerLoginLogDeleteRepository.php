<?php
namespace App\Http\Repositories\PalyerLoginLogRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\PalyerLoginLog;

class PalyerLoginLogDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new PalyerLoginLog();
    }
}