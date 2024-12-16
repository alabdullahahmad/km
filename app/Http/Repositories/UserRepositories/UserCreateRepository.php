<?php
namespace App\Http\Repositories\UserRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\User;

class UserCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new User();
    }
}
