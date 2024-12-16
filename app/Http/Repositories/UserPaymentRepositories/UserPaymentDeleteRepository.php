<?php
namespace App\Http\Repositories\UserPaymentRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\UserPayment;

class UserPaymentDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new UserPayment();
    }
}