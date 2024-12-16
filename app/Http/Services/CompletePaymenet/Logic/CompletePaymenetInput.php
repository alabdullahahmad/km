<?php
namespace App\Http\Services\CompletePaymenet\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class CompletePaymenetInput implements InputServiceInterface
{
    public int $stafId;
    public int $billId;
    public ?string $description;
    public int $amount;
    public string $date;
    public function __construct( array $input)
    {
        $this->stafId = $input['stafId'];
        $this->billId = $input['billId'];
        $this->description = $input['description'];
        $this->amount = $input['amount'];
        $this->date = $input['date'] ?? date('Y-m-d');
    }

    // write your input function here..

    public function toArray(){
        return [
            'stafId' => $this->stafId,
            'billId' => $this->billId,
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $this->date
        ];
    }
}