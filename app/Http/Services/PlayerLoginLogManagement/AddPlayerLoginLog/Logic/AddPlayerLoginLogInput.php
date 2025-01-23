<?php
namespace App\Http\Services\PlayerLoginLogManagement\AddPlayerLoginLog\logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddPlayerLoginLogInput implements InputServiceInterface
{
    private int $billId;
    public int $userId;
    public string $subscriptionName;
    public string $date;
    public function __construct( array $input)
    {
        $this->userId = $input['user_id'];
        $this->subscriptionName = $input['subscription_name'];
        $this->date = $input['date'] ?? date('Y-m-d H:i');
        $this->billId = $input['billId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'userId' => $this->userId,
            'date' => $this->date,
            'subscriptionName' => $this->subscriptionName
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