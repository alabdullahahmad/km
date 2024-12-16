<?php
namespace App\Http\Repositories\SubscriptionRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\Subscription;

class SubscriptionCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new Subscription();
    }
}