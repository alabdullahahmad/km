<?php
namespace App\Http\Services\DiscountsManagement\DeleteDiscounts\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeleteDiscountsInput implements InputServiceInterface
{
    private int $discountId;
    public function __construct( array $input)
    {
        $this->discountId = $input['discountId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    /**
     * Get the value of discountId
     */
    public function getDiscountId()
    {
        return $this->discountId;
    }

    /**
     * Set the value of discountId
     *
     * @return  self
     */
    public function setDiscountId($discountId)
    {
        $this->discountId = $discountId;

        return $this;
    }

}
