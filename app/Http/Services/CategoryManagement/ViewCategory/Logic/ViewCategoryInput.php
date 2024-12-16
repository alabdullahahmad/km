<?php
namespace App\Http\Services\CategoryManagement\ViewCategory\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ViewCategoryInput implements InputServiceInterface
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