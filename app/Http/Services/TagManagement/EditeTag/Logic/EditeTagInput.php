<?php
namespace App\Http\Services\TagManagement\EditeTag\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeTagInput implements InputServiceInterface
{
    private int $tagId;
    public string $name;
    public int $categoryId;
    public function __construct( array $input)
    {
        $this->tagId = $input['tagId'];
        $this->name = $input['name'];
        $this->categoryId = $input['category_id'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'name'=>$this->name,
            'categoryId'=>$this->categoryId
        ];
    }

    /**
     * Get the value of tagId
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * Set the value of tagId
     *
     * @return  self
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;

        return $this;
    }
}
