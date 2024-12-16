<?php
namespace App\Http\Services\DiscountsManagement\AddDiscounts\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddDiscountsInput implements InputServiceInterface
{
    private string $name;
    private int $amount;
    public function __construct( array $input)
    {
        $this->name = $input['name'];
        $this->amount = $input['amount'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'name'=>$this->getName(),
            'amount'=>$this->getAmount(),
        ];
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

}
