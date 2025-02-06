<?php
namespace App\Http\Repositories\DailyLoginRepositories;

use App\Http\Core\Repositories\ReadRepository;
use App\Models\DailyLogin;

class DailyLoginReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new DailyLogin();
    }

}
