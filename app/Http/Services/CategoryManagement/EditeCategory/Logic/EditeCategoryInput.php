<?php
namespace App\Http\Services\CategoryManagement\EditeCategory\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeCategoryInput implements InputServiceInterface
{
    private int $categoryId;
    public string  $name;
    public function __construct( array $input)
    {
        $this->name = $input['name'];
        $this->categoryId = $input['categoryId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'name'=>$this->name
        ];
    }

    /**
     * Get the value of categoryId
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set the value of categoryId
     *
     * @return  self
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }
}
