<?php
namespace App\Http\Repositories\DailyLoginRepositories;

use App\Http\Core\Repositories\DeleteRepository;
use App\Models\DailyLogin;

class DailyLoginDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new DailyLogin();
    }
}
