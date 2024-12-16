<?php
namespace App\Http\Repositories\StafRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\Staf;

class StafUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new Staf();
    }

}