<?php
namespace App\Http\Repositories\AdminRepositories;
use App\Repositories\basic\DeleteRepository;
use App\Models\Admin;

class AdminDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new Admin();
    }
}