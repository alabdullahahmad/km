<?php
namespace App\Http\Services\BranchManagement\BranchCalander\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class BranchCalanderInput implements InputServiceInterface
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