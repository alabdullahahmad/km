<?php
namespace App\Http\Repositories\UserPaymentRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\UserPayment;
use Illuminate\Support\Facades\DB;

class UserPaymentReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new UserPayment();
    }

    public function getWithFirstBill(int $billId){
        return $this->model->with('bill')->where('billId',$billId)->first();
    }

}
