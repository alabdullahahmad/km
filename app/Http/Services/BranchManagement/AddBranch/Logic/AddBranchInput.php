<?php
namespace App\Http\Services\BranchManagement\AddBranch\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddBranchInput implements InputServiceInterface
{
    public string $name;
    public string $address;
    public string $city;
    public int $fundAmount = 0;
    public function __construct( $input)
    {
        $this->name = $input->name;
        $this->address = $input->address;
        $this->city = $input->city;
        $this->fundAmount = $input->fundAmount ?? 0;
    }

    // write your input function here..

    public function toArray(){
        return [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'fundAmount' => $this->fundAmount
        ];
    }
}
