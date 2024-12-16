<?php
namespace App\Http\Services\BranchManagement\DeleteBranch\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeleteBranchInput implements InputServiceInterface
{
    private int $branchId;
    public function __construct( array $input)
    {
        $this->branchId = $input['branchId'];
    }

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }

    /**
     * Get the value of branchId
     */
    public function getBranchId()
    {
        return $this->branchId;
    }

    /**
     * Set the value of branchId
     *
     * @return  self
     */
    public function setBranchId($branchId)
    {
        $this->branchId = $branchId;

        return $this;
    }
}
