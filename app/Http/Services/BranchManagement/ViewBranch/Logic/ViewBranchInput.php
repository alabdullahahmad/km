<?php
namespace App\Http\Services\BranchManagement\ViewBranch\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewBranchInput implements InputServiceInterface
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