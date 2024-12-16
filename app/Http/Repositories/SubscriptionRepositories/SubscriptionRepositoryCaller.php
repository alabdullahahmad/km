<?php
namespace App\Http\Repositories\SubscriptionRepositories;

use App\Http\Repositories\SubscriptionRepositories\SubscriptionReadRepository;
use App\Http\Repositories\SubscriptionRepositories\SubscriptionCreateRepository;
use App\Http\Repositories\SubscriptionRepositories\SubscriptionDeleteRepository;
use App\Http\Repositories\SubscriptionRepositories\SubscriptionUpdateRepository;

class SubscriptionRepositoryCaller{

    static public function createRepository(){return (new SubscriptionCreateRepository());}
    static public function readRepository(){return (new SubscriptionReadRepository());}
    static public function updateRepository(){return (new SubscriptionUpdateRepository());}
    static public function deleteRepository(){return (new SubscriptionDeleteRepository());}

}
