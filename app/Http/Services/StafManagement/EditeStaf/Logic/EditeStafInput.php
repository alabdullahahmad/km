<?php

namespace App\Http\Services\StafManagement\EditeStaf\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;
use Illuminate\Support\Facades\Hash;

class EditeStafInput implements InputServiceInterface
{
    public int $stafId;
    public string $name;
    public ?string $address;
    public ?string $personalid;
    public string $gender;
    public ?string $birthDay;
    public ?string $password;
    public ?string $phoneNumber;
    public int $branchId;
    public int $roleId;


    // public bool $isAdmin;

    public function __construct($input)
    {
        $this->stafId = $input->stafId;
        $this->name = $input->name;
        $this->address = $input->address;
        $this->personalid = $input->personalid;
        $this->gender = $input->gender;
        $this->birthDay = $input->birthDay;
        $this->password = $input->password;
        $this->phoneNumber = $input->phoneNumber;
        $this->branchId = $input->branchId;
        $this->roleId = $input->roleId;

        // $this->isAdmin = $input->isAdmin ;
    }

    // write your input function here..

    public function toArray($staf)
    {
        return [
            'name' => $this->name ?? $staf->name,
            'address' => $this->address ?? $staf->address,
            'personalid' => $this->personalid ?? $staf->personalid,
            'gender' => $this->gender ?? $staf->gender,
            'birthDay' => $this->birthDay ?? $staf->birthDay,
            'password' => $this->password ? Hash::make($this->password) : $staf->password,
            'phoneNumber' => $this->phoneNumber ?? $staf->phoneNumber,
            'branchId' => $this->branchId
            // 'isAdmin' => $this->isAdmin
        ];
    }

    /**
     * Get the value of stafId
     */
    public function getStafId()
    {
        return $this->stafId;
    }

    /**
     * Set the value of stafId
     *
     * @return  self
     */
    public function setStafId($stafId)
    {
        $this->stafId = $stafId;

        return $this;
    }
}
