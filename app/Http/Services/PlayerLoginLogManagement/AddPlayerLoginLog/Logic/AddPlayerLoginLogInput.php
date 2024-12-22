<?php
namespace App\Http\Services\PlayerLoginLogManagement\AddPlayerLoginLog\logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddPlayerLoginLogInput implements InputServiceInterface
{
    public int $userId;
    public string $subscriptionName;
    public string $date;
    public function __construct( array $input)
    {
        $this->userId = $input['user_id'];
        $this->subscriptionName = $input['subscription_name'];
        $this->date = $input['date'] ?? date('Y-m-d H:i');
    }

    // write your input function here..

    public function toArray(){
        return [
            'userId' => $this->userId,
            'date' => $this->date,
            'subscriptionName' => $this->subscriptionName
        ];
    }
}