<?php
namespace App\Http\Repositories\BillRepositories;
use App\Models\Bill;
use Illuminate\Support\Facades\DB;
use App\Http\Core\Repositories\ReadRepository;

class BillReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new Bill();
    }

    public function getGroupByForFund(array $data =null ,$groupBy ='date',$with=[]){
        $model = $this->model->query()
        ->join('user_payments' , 'user_payments.billId' , '=' , 'bills.id')->select(
            [
                'bills.date',
                'bills.branchId',
                DB::raw("SUM(CASE WHEN bills.payType = 'in' THEN user_payments.amount ELSE 0 END) AS cashIn"),
                DB::raw("SUM(CASE WHEN bills.payType = 'out' THEN user_payments.amount ELSE 0 END) AS cashOut")
            ]
            );
        if ($data) {
            $model = $model->whereBetween('bills.date', $data);
        }
        return $model->with($with)->groupBy($groupBy)->get();
    }

    public function getBillReport(array $data = null){
        $model = $this->model->query()->with(['user','staf'
        ,'subscription' , 'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId');
        }]);
        if ($data) {
            $model = $model->whereBetween('date', $data);
        }
        return $model->get();
    }


    public function getUsersBill(array $data = null){

        $model = $this->model->query()->with(['user','subscription', 'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId');
        },
        'branch' => function($q){
            return $q->select('id','name');
        }
        ])->where(
            'userId' , "!=" , null
        )->where($data);
        return $model->orderby('created_at','DESC')->get();

    }


    public function getBillUsers($userId){

        $model = $this->model->query()->with(['subscription','userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId');
            }])->where(
            ['userId' => $userId , 'isEnd' => 0]
        );
        return $model->get();

    }


    public function getBillReportForUser(int $userId){
        return  $this->model->query()->with(['staf','subscription', 'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId');
        }])->where(['userId' => $userId , 'isEnd' => 0])->get();
    }

    public function getGroupByForClass(array $data = null){
        $model = $this->model->query()
        ->join('coaches', 'coaches.id', '=', 'bills.coachId')  // الربط مع جدول المدربين
        ->select(
            [
                DB::raw("SUM(CASE WHEN price IS NOT NULL THEN price ELSE 0 END) AS total"),
                DB::raw("SUM(CASE WHEN price IS NOT NULL THEN price * (coaches.percentage / 100) ELSE 0 END) AS totalPercentage"),
                'bills.coachId',
                'bills.subscriptionId',
                'bills.branchId',
                'bills.created_at'
            ]
        );

        if ($data) {
            $model = $model->whereBetween('bills.created_at',$data);
        }

        return $model->with(['coach'=>function($q){
            return $q->select('id','name');
        },
        'subscription'=>function($q){
            return $q->select('id','name');
        },
        'branch' => function($q){
            return $q->select('id','name');
        }
        ])->where('coachId','!=',null)->groupBy(['coachId','subscriptionId'])->get();
    }

    public function getBillReportForClass(array $condation){
        $model = $this->model->query()->select(['id','coachId','subscriptionId','userId','branchId','stafId'])
        ->with(['user'=>function($q){
            return $q->select(['id','name','gender','birthDay','phoneNumber'])->get();
        },'subscription'=>function($q){
            return $q->select('id','name','price');
        },
        'branch' => function($q){
            return $q->select('id','name');
        },
        'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId');}
        ,'staf' => function($q){
            return $q->select('id','name');
        }]);
        return $model->where($condation)->get();
    }



    public function getUsersDues(array $data = null){
        $model = $this->model->query()->with(['user:id,name','staf:id,name',
        'subscription:id,name', 'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId');
        },
            'branch' => function($q){
                return $q->select('id','name');
            }
        ]);

        if ($data) {
            $model = $model->whereBetween('date', $data);
        }
        return $model->where('subscriptionId','!=',null)->where('isCompletePayment',false)->get();
    }

    public function getBillPaymenet(int $billId){
        return $this->model->with(['userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId');
        }])->find($billId);
    }

    public function getComplexReport(array $data = null , $with = [],$condation = []){
        $model = $this->model->query()->with(['user','subscriptionCoach','staf','coach'=>function($q){return $q->select('id','name')->get();}
        ,'subscription'=>function($q){return $q->select('id','name','tagId')->with('tag')->get();} , 'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId');
        }]);
        if ($data) {
            $model = $model->whereBetween('date', $data);
        }
        return $model->where($condation)->with($with)/*->where('userId','!=',null)*/->get();
    }


    public function checkLoginUser($userId)
    {
        $date = date("Y-m-d H:i");
        return $this->model->with(['subscription'=>function($q){
            return $q->select('id','name');
        }])->where('userId', $userId)
            ->where('endDate', ">=", $date)
            ->where('startDate', '<=', $date)
            ->where(function ($query) use ($date) {
                $query->where(function ($subQuery) use ($date) {
                    $subQuery->where('startDateFreeze', '<', $date)
                             ->where('endDateFreeze', '>', $date);
                })
                ->orWhereNull('startDateFreeze')
                ->orWhereNull('endDateFreeze');
            })
            ->orderBy('updated_at', 'desc')
            ->get();
    }
    

    public function endBill($userId){
        return $this->model->with(['subscription'=>function($q){
            return $q->select('id','name');
        }])->where('userId',$userId)->where('isEnd',1)->latest('updated_at')->first();
    }
}
