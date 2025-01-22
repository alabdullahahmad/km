<?php
namespace App\Http\Services\EditBillDate\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;
use Illuminate\Support\Carbon;

class EditBillDateInput implements InputServiceInterface
{
    public int $billId;
    public string $date;
    public ?string $startDate;

    public function __construct( array $input)
    {
        $this->billId = $input['billId'];
        $this->startDate = $input['startDate'] ?? $input['date'];
        $this->date = $input['date'] ;
    }

    // write your input function here..

    public function toArray(){
        return [
            'date' => $this->date,
            'startDate' => $this->startDate,
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

    public function getEndDate(int $numofDays,string $startDate){
        $date =  Carbon::parse($startDate);
        return $date->addDays($numofDays)->format('Y-m-d');
    }
}
