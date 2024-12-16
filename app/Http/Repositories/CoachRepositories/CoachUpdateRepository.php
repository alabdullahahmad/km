<?php
namespace App\Http\Repositories\CoachRepositories;

use App\Models\Coach;
use App\Http\Core\Repositories\UpdateRepository;

class CoachUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new Coach();
    }

}
