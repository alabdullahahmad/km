<?php
namespace App\Http\Services\Report\BillReport\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class BillReportInput implements InputServiceInterface
{
    public ?string $startDate;
    public ?string $endDate;
    public ?int $branchId;
    public function __construct( array $input)
    {
        $this->startDate = $input['startDate'] ?? null;
        $this->endDate = $input['endDate'] ?? null;
        $this->branchId = $input['branchId'] ?? null;
    }

    // write your input function here..

    public function toArray(){
        if ($this->startDate && $this->endDate) {
            return [
                $this->startDate,
                $this->endDate
            ];
        }
        return null;

    }
}
