<?php
namespace App\Http\Services\CategoryManagement\DeleteCategory\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeleteCategoryInput implements InputServiceInterface
{
    private int $categoryId;

    public function __construct(  $input)
    {
        $this->categoryId = $input;

    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
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
