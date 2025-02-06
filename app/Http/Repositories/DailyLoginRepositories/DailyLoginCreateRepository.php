<?php
namespace App\Http\Repositories\DailyLoginRepositories;

use App\Http\Core\Repositories\CreateRepository;
use App\Models\DailyLogin;

class DailyLoginCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new DailyLogin();
    }
}
