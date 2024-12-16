<?php
namespace App\Http\Repositories\SubscriptionCoachRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\SubscriptionCoach;

class SubscriptionCoachCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new SubscriptionCoach();
    }
}
