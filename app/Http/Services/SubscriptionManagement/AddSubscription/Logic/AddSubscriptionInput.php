<?php
namespace App\Http\Services\SubscriptionManagement\AddSubscription\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddSubscriptionInput implements InputServiceInterface
{
    public int $tagId;
    public int $categoryId;
    public string $name;
    public int $price;
    public int $numOfDays;
    public int $numOfSessions;
    public string $description;
    public int $branchId;

    public function __construct( array $input)
    {
        $this->tagId = $input['tagId'];
        $this->categoryId = $input['categoryId'];
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
            'tagId' => $this->tagId,
            'categoryId' => $this->categoryId,
            'name' => $this->name,
            'price' => $this->price,
            'numOfDays' => $this->numOfDays,
            'numOfSessions' => $this->numOfSessions,
            'description' => $this->description,
            'branchId' => $this->branchId
        ];
    }
}
