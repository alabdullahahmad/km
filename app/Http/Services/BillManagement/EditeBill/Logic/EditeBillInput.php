<?php
namespace App\Http\Services\BillManagement\EditeBill\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeBillInput implements InputServiceInterface
{
    public int $billId;
    public string $payType;
    public ?string $date;
    public int $amount;
    public string $description;

    public function __construct( array $input)
    {
        $this->billId = $input['billId'];
        $this->payType = $input['payType'];
        $this->date = $input['date'] ?? date("Y-m-d");
        $this->amount = $input['amount'];
        $this->description = $input['description'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'payType' => $this->payType,
            'date' => $this->date,
            'amount' => $this->amount,
            'description' => $this->description
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
