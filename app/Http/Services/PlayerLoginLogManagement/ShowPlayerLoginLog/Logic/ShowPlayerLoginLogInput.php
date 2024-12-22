<?php
namespace App\Http\Services\PlayerLoginLogManagement\ShowPlayerLoginLog\logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowPlayerLoginLogInput implements InputServiceInterface
{
    private int $userId;
    public function __construct( array $input)
    {
        $this->userId = $input['userId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'userId' => $this->userId
        ];
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}