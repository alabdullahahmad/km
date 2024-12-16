<?php
namespace App\Http\Services\BranchManagement\EditeBranch\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeBranchInput implements InputServiceInterface
{
    public int $branchId;
    public string $name;
    public string $address;
    public string $city;

    public function __construct( $input)
    {
        $this->branchId = $input->branchId;
        $this->name = $input->name;
        $this->address = $input->address;
    }

    // write your input function here..

    public function toArray(){
        return [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city
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
