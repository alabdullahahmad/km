<?php
namespace App\Http\Services\EditUserBill\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditUserBillInput implements InputServiceInterface
{
    public int $billId;
    public int $subscriptionId;
    public ?int $coachId;
    public ?int $subscriptionCoachId;
    public int $price;


    public function __construct( array $input)
    {
        $this->billId = $input['billId'];
        $this->subscriptionId = $input['subscriptionId'];
        $this->coachId = $input['coachId'] ?? null;
        $this->subscriptionCoachId = $input['subscriptionCoachId'] ?? null;
        $this->price = $input['price'];

    }

    // write your input function here..

    public function toArray(){
        return [
            'subscriptionId' => $this->subscriptionId,
            'coachId' => $this->coachId,
            'subscriptionCoachId' => $this->subscriptionCoachId,
            'price' => $this->price,
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
