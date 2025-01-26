<?php
namespace App\Http\Services\Report\UserReport\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class UserReportInput implements InputServiceInterface
{
    public ?string $startDate;
    public ?string $endDate;
    public ?string $gender;
    public function __construct( array $input)
    {
        $this->startDate = $input['startDate'] ?? null;
        $this->endDate = $input['endDate'] ?? null;
        $this->gender = $input['gender'] ?? null;
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
