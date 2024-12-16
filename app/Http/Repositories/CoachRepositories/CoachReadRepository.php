<?php
namespace App\Http\Repositories\CoachRepositories;

use App\Models\Coach;
use App\Http\Core\Repositories\ReadRepository;

class CoachReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new Coach();
    }

    public function getByTagWithSubsciption()
    {
        return $this->model->whereHas('calander')->with('calander')->get();
    }
}
