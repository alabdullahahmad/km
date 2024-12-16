<?php
namespace App\Http\Services\Report\ClassReportDetails\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ClassReportDetailsInput implements InputServiceInterface
{
    public int $subscriptionId;
    public int $coachId;
    public function __construct( array $input)
    {
        $this->subscriptionId = $input['subscriptionId'];
        $this->coachId = $input['coachId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'subscriptionId' => $this->subscriptionId,
            'coachId' => $this->coachId
        ];
    }
}