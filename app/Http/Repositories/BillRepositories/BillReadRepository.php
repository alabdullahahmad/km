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
                'branchId',
                DB::raw("SUM(CASE WHEN bills.payType = 'in' THEN user_payments.amount ELSE 0 END) AS cashIn"),
                DB::raw("SUM(CASE WHEN bills.payType = 'out' THEN user_payments.amount ELSE 0 END) AS cashOut")
            ]
            );
        if ($data) {
            $model = $model->whereBetween('date', $data);
        }
        return $model->with($with)->groupBy($groupBy)->get();
    }

    public function getBillReport(array $data = null){
        $model = $this->model->query()->with(['user','staf'
        ,'subscription' , 'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId')->first();
        }]);
        if ($data) {
            $model = $model->whereBetween('date', $data);
        }
        return $model->get();
    }


    public function getUsersBill(array $data = null){

        $model = $this->model->query()->with(['user','subscription', 'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId')->first();
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
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId')->first();
            }])->where(
            ['userId' => $userId , 'isEnd' => 0]
        );
        return $model->get();

    }


    public function getBillReportForUser(int $userId){
        return  $this->model->query()->with(['staf','subscription', 'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId')->first();
        }])->where(['userId' => $userId , 'isEnd' => 0])->get();
    }

    public function getGroupByForClass(array $data = null){
        $model = $this->model->query()
        ->join('coaches', 'coaches.id', '=', 'bills.coachId')  // الربط مع جدول المدربين
        ->select(
            [
                DB::raw("SUM(CASE WHEN price IS NOT NULL THEN price ELSE 0 END) AS total"),
                DB::raw("SUM(CASE WHEN price IS NOT NULL THEN price * (coaches.percentage / 100) ELSE 0 END) AS totalPercentage"),
                'coachId',
                'subscriptionId',
                'branchId'
            ]
        );

        if ($data) {
            $model = $model->whereBetween('date',$data);
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
        $model = $this->model->query()->select(['id','coachId','subscriptionId','userId'])
        ->with(['user'=>function($q){
            return $q->select(['id','name','gender','birthDay','phoneNumber'])->get();
        }]);
        return $model->where($condation)->get();
    }



    public function getUsersDues(array $data = null){
        $model = $this->model->query()->with(['user:id,name','staf:id,name',
        'subscription:id,name', 'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId')->first();
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
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId')->first();
        }])->find($billId);
    }

    public function getComplexReport(array $data = null , $with = [],$condation = []){
        $model = $this->model->query()->with(['user','subscriptionCoach','staf','coach'=>function($q){return $q->select('id','name')->get();}
        ,'subscription'=>function($q){return $q->select('id','name','tagId')->with('tag')->get();} , 'userPayment'=>function($q){
            return $q->select(['id','billId', DB::raw('SUM(amount) as totalAmount')])->groupBy('billId')->first();
        }]);
        if ($data) {
            $model = $model->whereBetween('date', $data);
        }
        return $model->where($condation)->with($with)/*->where('userId','!=',null)*/->get();
    }


}
