<?php
namespace App\Http\Repositories\fundRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\fund;

class fundCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new fund();
    }
}