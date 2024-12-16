<?php
namespace App\Http\Repositories\CoachRepositories;

use App\Models\Coach;
use App\Http\Core\Repositories\CreateRepository;

class CoachCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new Coach();
    }
}
