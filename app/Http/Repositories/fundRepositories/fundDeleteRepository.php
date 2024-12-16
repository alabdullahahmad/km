<?php
namespace App\Http\Repositories\fundRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\fund;

class fundDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new fund();
    }
}