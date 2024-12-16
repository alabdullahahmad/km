<?php
namespace App\Http\Services\StafManagement\EditeStaf\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeStafInput implements InputServiceInterface
{
    public int $stafId;
    public string $name;
    public ?string $address;
    public ?string $personalid;
    public string $gender;
    public ?string $birthDay;
    // public bool $isAdmin;

    public function __construct( $input)
    {
        $this->stafId = $input->stafId;
        $this->name = $input->name;
        $this->address = $input->address;
        $this->personalid = $input->personalid;
        $this->gender = $input->gender;
        $this->birthDay = $input->birthDay;
        // $this->isAdmin = $input->isAdmin ;
    }

    // write your input function here..

    public function toArray(){
        return [
            'name' => $this->name,
            'address' => $this->address,
            'personalid' => $this->personalid,
            'gender' => $this->gender,
            'birthDay'=>$this->birthDay,
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
