<?php
namespace App\Http\Repositories\SubscriptionCoachRepositories;

class SubscriptionCoachRepositoryCaller{

    static public function createRepository(){return (new SubscriptionCoachCreateRepository());}
    static public function readRepository(){return (new SubscriptionCoachReadRepository());}
    static public function updateRepository(){return (new SubscriptionCoachUpdateRepository());}
    static public function deleteRepository(){return (new SubscriptionCoachDeleteRepository());}

}