<?php
namespace App\Http\Services\SubscriptionManagement\EditeSubscription\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeSubscriptionInput implements InputServiceInterface
{
    public int $subscriptionId;
    public string $name;
    public int $price;
    public int $numOfDays;
    public int $numOfSessions;
    public string $description;
    public int $branchId;


    public function __construct( array $input)
    {
        $this->subscriptionId = $input['subscriptionId'];
        $this->name = $input['name'];
        $this->price = $input['price'];
        $this->numOfDays = $input['numOfDays'];
        $this->numOfSessions = $input['numOfSessions'];
        $this->description = $input['description'] ?? '';
        $this->branchId = $input['branchId'];

    }

    // write your input function here..

    public function toArray(){
        return [
            'name' => $this->name,
            'price' => $this->price,
            'numOfDays' => $this->numOfDays,
            'numOfSessions' => $this->numOfSessions,
            'description' => $this->description,
            'branchId' => $this->branchId
        ];
    }

    /**
     * Get the value of subscriptionId
     */
    public function getSubscriptionId()
    {
        return $this->subscriptionId;
    }

    /**
     * Set the value of subscriptionId
     *
     * @return  self
     */
    public function setSubscriptionId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;

        return $this;
    }
}
