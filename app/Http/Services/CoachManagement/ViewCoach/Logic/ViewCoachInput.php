<?php
namespace App\Http\Services\CoachManagement\ViewCoach\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewCoachInput implements InputServiceInterface
{
    public function __construct( array $input)
    {}

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }
}