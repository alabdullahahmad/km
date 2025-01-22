<?php
namespace App\Http\Services\SubscriptionManagement\ShowSubscription\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowSubscriptionInput implements InputServiceInterface
{
    private int $tagId;
    public ?int $billId;
    public function __construct( array $input)
    {
        $this->tagId = $input['tagId'];
        $this->billId = $input['billId'] ?? null;
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    /**
     * Get the value of subscriptionId
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * Set the value of tagId
     *
     * @return  self
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;

        return $this;
    }
}
