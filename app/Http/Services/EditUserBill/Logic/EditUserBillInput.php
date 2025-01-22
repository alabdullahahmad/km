<?php
namespace App\Http\Services\BillManagement\EditUserBill\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditUserBillInput implements InputServiceInterface
{
    public int $billId;
    public int $subscriptionId;
    public ?int $coachId;
    public ?int $subscriptionCoachId;

    public function __construct( array $input)
    {
        $this->billId = $input['billId'];
        $this->subscriptionId = $input['subscriptionId'];
        $this->coachId = $input['coachId'] ?? null;
        $this->coachId = $input['subscriptionCoachId'] ?? null;
    }

    // write your input function here..

    public function toArray(){
        return [
            'subscriptionId' => $this->subscriptionId,
            'coachId' => $this->coachId,
            'coachId' => $this->coachId
        ];
    }

    /**
     * Get the value of billId
     */
    public function getBillId()
    {
        return $this->billId;
    }

    /**
     * Set the value of billId
     *
     * @return  self
     */
    public function setBillId($billId)
    {
        $this->billId = $billId;

        return $this;
    }
}
