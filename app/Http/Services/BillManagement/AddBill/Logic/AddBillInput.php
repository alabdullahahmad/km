<?php
namespace App\Http\Services\BillManagement\AddBill\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AddBillInput implements InputServiceInterface
{
    // public int $branchId;
    public ?string $payType;
    public string $date;
    public int $amount;
    public int $stafId;
    public string $description;
    public ?int $discountAmount;
    public ?string $discountBecouse;
    public ?string $startDate;
    public ?string $endDate;
    public ?string $paymrentNote;
    public ?int $coachId;
    public ?int $subscriptionId;
    public ?int $userId;
    public ?int $price;
    public ?int $numOfDays;
    public ?int $subscriptionCoachId;

    public function __construct( array $input)
    {
        // $this->branchId = $input['branchId'];
        $this->payType = $input['payType'] ?? 'in';
        $this->date = $input['date'] ?? date("Y-m-d H:i");
        $this->amount = $input['amount'];
        $this->description = $input['description'];
        $this->stafId = Auth::id();
        $this->discountAmount = $input['discountAmount'] ?? null;
        $this->discountBecouse = $input['discountBecouse'] ?? null;
        $this->startDate = $input['startDate'] ?? null;
        $this->paymrentNote = $input['paymrentNote'] ?? null;
        $this->coachId = $input['coachId'] ?? null;
        $this->subscriptionId = $input['subscriptionId'] ?? null;
        $this->userId = $input['userId'] ?? null;
        $this->price = $input['price'] ?? $this->amount;
        $this->numOfDays = $input['numOfDays'] ?? 0;
        $this->subscriptionCoachId = $input['subscriptionCoachId'] ?? null;
    }

    // write your input function here..

    public function toArray(){
        return [
            // 'branchId' => $this->branchId,
            'payType' => $this->payType,
            'date' => $this->date,
            'amount' => $this->amount,
            'description' => $this->description,
            'stafId' =>  $this->stafId,
            'discountAmount' => $this->discountAmount ?? 0,
            'discountBecouse' => $this->discountBecouse,
            'startDate' => $this->startDate,
            'endDate' => $this->getEndDate($this->startDate),
            'paymrentNote' => $this->paymrentNote,
            'coachId' => $this->coachId,
            'subscriptionId' => $this->subscriptionId,
            'userId' => $this->userId,
            'price' => $this->price,
            'subscriptionCoachId' => $this->subscriptionCoachId,
            'branchId' => auth()->user()->branchId
        ];
    }

    public function getEndDate(?string $startDate){
        if (!$startDate) {
            return null;
        }
        $date =  Carbon::parse($startDate);
        return $date->addDays($this->numOfDays)->format('Y-m-d');
    }
}
