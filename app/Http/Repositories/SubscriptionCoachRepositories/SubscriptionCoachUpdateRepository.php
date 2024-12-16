<?php
namespace App\Http\Repositories\SubscriptionCoachRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\SubscriptionCoach;

class SubscriptionCoachUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new SubscriptionCoach();
    }

}
