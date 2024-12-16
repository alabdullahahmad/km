<?php
namespace App\Http\Repositories\SubscriptionRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\Subscription;

class SubscriptionDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new Subscription();
    }
}