<?php

namespace App\Http\Services\CategoryManagement\AddCategory\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddCategoryInput implements InputServiceInterface
{
    public string $name;
    public function __construct( array $input)
    {
        $this->name = $input['name'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'name'=>$this->name
        ];
    }
}
