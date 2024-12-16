<?php
namespace App\Http\Repositories\CoachRepositories;

use App\Models\Coach;
use App\Http\Core\Repositories\DeleteRepository;

class CoachDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new Coach();
    }
}
