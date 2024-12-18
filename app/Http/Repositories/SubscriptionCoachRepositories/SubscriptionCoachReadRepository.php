<?php
namespace App\Http\Repositories\SubscriptionCoachRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\SubscriptionCoach;

class SubscriptionCoachReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new SubscriptionCoach();
    }

    public function getWithRelations(int $subscriptionCoachId)
    {
        return $this->model->with(['coach' , 'subscription'])->where('subscriptionId', $subscriptionCoachId)->get();
    }


    public function getAllWithRelations(array $condaion){
        return $this->model->where($condaion)->with(['coach' , 'subscription'])->get();
    }

    public function getAllWithCoachRelations()
    {
        return $this->model->with('coach')->get();
    }

}
