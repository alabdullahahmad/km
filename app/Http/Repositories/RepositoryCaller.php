<?php
namespace App\Http\Repositories;

use App\Http\Repositories\TagRepositories\TagRepositoryCaller;

use App\Http\Repositories\BillRepositories\BillRepositoryCaller;
use App\Http\Repositories\fundRepositories\fundRepositoryCaller;
use App\Http\Repositories\RoomRepositories\RoomRepositoryCaller;
use App\Http\Repositories\StafRepositories\StafRepositoryCaller;
use App\Http\Repositories\UserRepositories\UserRepositoryCaller;
use App\Http\Repositories\AdminRepositories\AdminRepositoryCaller;
use App\Http\Repositories\CoachRepositories\CoachRepositoryCaller;
use App\Http\Repositories\branchRepositories\branchRepositoryCaller;

use App\Http\Repositories\CategoryRepositories\CategoryRepositoryCaller;
use App\Http\Repositories\DiscountsRepositories\DiscountsRepositoryCaller;
use App\Http\Repositories\FundLogRepositories\FundLogRepositoryCaller;
use App\Http\Repositories\SubscriptionRepositories\SubscriptionRepositoryCaller;
use App\Http\Repositories\SubscriptionCoachRepositories\SubscriptionCoachRepositoryCaller;
use App\Http\Repositories\UserPaymentRepositories\UserPaymentRepositoryCaller;

class RepositoryCaller {

	static public function UserPaymentRepository(){return (new UserPaymentRepositoryCaller);}
    static public function FundLogRepository(){return (new FundLogRepositoryCaller);}
	static public function SubscriptionCoachRepository(){return (new SubscriptionCoachRepositoryCaller);}
	static public function SubscriptionRepository(){return (new SubscriptionRepositoryCaller);}
	static public function TagRepository(){return (new TagRepositoryCaller);}
	static public function CategoryRepository(){return (new CategoryRepositoryCaller);}
	static public function RoomRepository(){return (new RoomRepositoryCaller);}
	static public function UserRepository(){return (new UserRepositoryCaller);}
	static public function BillRepository(){return (new BillRepositoryCaller);}
	static public function fundRepository(){return (new fundRepositoryCaller);}
	static public function branchRepository(){return (new branchRepositoryCaller);}
	static public function StafRepository(){return (new StafRepositoryCaller);}
	static public function DiscountsRepository(){return (new DiscountsRepositoryCaller);}
	static public function CoachRepository(){return (new CoachRepositoryCaller);}
	static public function AdminRepository(){return (new AdminRepositoryCaller);}
}
