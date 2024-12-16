<?php
namespace App\Http\Services\TagManagement\AddTag\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddTagInput implements InputServiceInterface
{
    public string $name;
    public int $categoryId;
    public function __construct( array $input)
    {
        $this->name = $input['name'];
        $this->categoryId = $input['category_id'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'name' => $this->name,
            'categoryId' => $this->categoryId
        ];
    }
}
