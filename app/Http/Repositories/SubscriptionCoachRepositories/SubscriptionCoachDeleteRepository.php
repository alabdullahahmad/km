<?php
namespace App\Http\Repositories\SubscriptionCoachRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\SubscriptionCoach;

class SubscriptionCoachDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new SubscriptionCoach();
    }
}
