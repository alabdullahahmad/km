<?php
namespace App\Http\Services\EditBillFreeze\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;
use Illuminate\Support\Carbon;

class EditBillFreezeInput implements InputServiceInterface
{
    public int $billId;
    public string $startDateFreeze;
    public string $endDateFreeze;

    public function __construct( array $input)
    {
        $this->billId = $input['billId'];
        $this->startDateFreeze = $input['startDateFreeze'] ;
        $this->endDateFreeze = $input['endDateFreeze'] ;
    }

    // write your input function here..

    public function toArray(){
        return [
            'startDateFreeze' => $this->startDateFreeze,
            'endDateFreeze' => $this->endDateFreeze,
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

    public function getEndDate(string $endDate){
        $date1 = Carbon::createFromFormat('Y-m-d', $this->startDateFreeze);
        $date2 = Carbon::createFromFormat('Y-m-d', $this->endDateFreeze);

        $diffInDays = $date1->diffInDays($date2);

        $date =  Carbon::parse($endDate);
        return $date->addDays($diffInDays)->format('Y-m-d');
    }
}
