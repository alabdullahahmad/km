<?php
namespace App\Http\Services\StafManagement\AddStaf\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;
use Illuminate\Support\Facades\Hash;

class AddStafInput implements InputServiceInterface
{
    public string $name;
    public string $password;
    public string $phoneNumber;
    public ?string $address;
    public ?string $personalid;
    public string $gender;
    public ?string $birthDay;
    public ?bool $isAdmin;
    public int $branchId;
    public int $roleId;

    public function __construct( $input)
    {
        $this->name = $input->name;
        $this->password = $input->password;
        $this->phoneNumber = $input->phoneNumber;
        $this->address = $input->address;
        $this->personalid = $input->personalid;
        $this->gender = $input->gender;
        $this->birthDay = $input->birthDay;
        $this->isAdmin = $input->isAdmin ?? false;
        $this->branchId = $input->branchId;
        $this->roleId = $input->roleId;
    }

    // write your input function here..

    public function toArray(){
        return [
            'name' => $this->name,
            'password' => Hash::make($this->password),
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'personalid' => $this->personalid,
            'gender' => $this->gender,
            'birthDay'=>$this->birthDay,
            'isAdmin' => $this->isAdmin,
            'branchId' => $this->branchId,
        ];
    }
}
