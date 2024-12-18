<?php
namespace App\Http\Services\TagManagement\ShowTag\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowTagInput implements InputServiceInterface
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
     * Get the value of tagId
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set the value of tagId
     *
     * @return  self
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }
}
