<?php
namespace App\Http\Repositories\SubscriptionRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\Subscription;

class SubscriptionUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new Subscription();
    }

}