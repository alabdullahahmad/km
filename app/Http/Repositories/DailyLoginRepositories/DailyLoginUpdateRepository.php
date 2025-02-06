<?php
namespace App\Http\Repositories\DailyLoginRepositories;

use App\Http\Core\Repositories\UpdateRepository;
use App\Models\DailyLogin;

class DailyLoginUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new DailyLogin();
    }

}
