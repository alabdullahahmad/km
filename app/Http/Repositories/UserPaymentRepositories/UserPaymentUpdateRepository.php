<?php
namespace App\Http\Repositories\UserPaymentRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\UserPayment;

class UserPaymentUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new UserPayment();
    }

}