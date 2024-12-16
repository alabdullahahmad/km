<?php
namespace App\Http\Services\CategoryManagement\ShowCategory\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowCategoryInput implements InputServiceInterface
{
    private int $categoryId;
    public function __construct( array $input)
    {
        $this->categoryId = $input['categoryId'];
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
