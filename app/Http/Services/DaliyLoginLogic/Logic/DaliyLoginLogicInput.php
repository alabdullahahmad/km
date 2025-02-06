<?php
namespace App\Http\Services\DaliyLoginLogic\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DaliyLoginLogicInput implements InputServiceInterface
{
    public int $userId ;
    public function __construct( array $input)
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
