<?php
namespace App\Http\Services\TagManagement\ShowTag\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowTagInput implements InputServiceInterface
{
    private int $tagId;
    public function __construct( array $input)
    {
        $this->tagId = $input['tagId'];
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
