<?php
namespace App\Http\Services\Report\UserReportDetails\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class UserReportDetailsInput implements InputServiceInterface
{
    public int $userId;
    public function 
    __construct( array $input)
    {
        $this->userId = $input['userId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }
}