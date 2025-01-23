<?php
namespace App\Http\Services\BillManagement\DeleteBill\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeleteBillInput implements InputServiceInterface
{
    private int $billId;

    public function __construct(  $input)
    {
        $this->billId = $input['billId'];

    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
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
