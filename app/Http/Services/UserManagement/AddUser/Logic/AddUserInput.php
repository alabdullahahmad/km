<?php
namespace App\Http\Services\UserManagement\AddUser\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class AddUserInput implements InputServiceInterface
{

    public string $name;
    public ?string $birthDay;
    public string $gender;
    public string $phoneNumber;
    // public ?string $familyNumber;
    // public ?string $homeNumber;
    // public ?string $address;
    // public ?string $personalid;
    public ?string $qr;
    public function __construct( array $input)
    {
        $this->name = $input['name'];
        $this->birthDay = $input['birthDay'] ?? null;
        $this->gender = $input['gender'];
        $this->phoneNumber = $input['phoneNumber'];
        // $this->familyNumber = $input['familyNumber'] ?? null;
        // $this->homeNumber = $input['homeNumber'] ?? null;
        // $this->address = $input['address'] ?? null;
        // $this->personalid = $input['personalid'] ?? null;
        $this->qr = $input['qr'] ?? null;
    }

    // write your input function here..

    public function toArray(){
        return [
            'name' => $this->name,
            'birthDay' => $this->birthDay,
            'gender' => $this->gender,
            'phoneNumber' => $this->phoneNumber,
            // 'familyNumber' => $this->familyNumber,
            // 'homeNumber' => $this->homeNumber,
            // 'address' => $this->address,
            // 'personalid' => $this->personalid,
            'qr' => $this->qr,
        ];
    }
}
