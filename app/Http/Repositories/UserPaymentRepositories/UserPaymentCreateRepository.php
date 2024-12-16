<?php
namespace App\Http\Repositories\UserPaymentRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\UserPayment;

class UserPaymentCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new UserPayment();
    }
}
