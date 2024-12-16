<?php
namespace App\Http\Services\UserManagement\EditeUser\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class EditeUserInput implements InputServiceInterface
{
    public int $userId;
    public ?string $name;
    public ?string $birthDay;
    public ?string $gender;
    public ?string $familyNumber;
    public ?string $homeNumber;
    public ?string $address;
    public ?string $personalid;
    // public ?string $password;
    public ?string $qr;
    public function __construct( array $input)
    {
        $this->userId = $input['userId'];
        $this->name = $input['name'] ?? null;
        $this->birthDay = $input['birthDay'] ?? null;
        $this->gender = $input['gender'] ?? null;
        $this->familyNumber = $input['familyNumber'] ?? null;
        $this->homeNumber = $input['homeNumber'] ?? null;
        $this->address = $input['address'] ?? null;
        $this->personalid = $input['personalid'] ?? null;
        // $this->password = $input['password'];
        $this->qr = $input['qr'] ?? null;
    }

    // write your input function here..

    public function toArray($oldData){
        return [
            'name' => $this->name ?? $oldData->name,
            'birthDay' => $this->birthDay ?? $oldData->birthDay,
            'gender' => $this->gender ?? $oldData->gender,
            'familyNumber' => $this->familyNumber ?? $oldData->familyNumber,
            'homeNumber' => $this->homeNumber ?? $oldData->homeNumber,
            'address' => $this->address ?? $oldData->address,
            'personalid' => $this->personalid ?? $oldData->personalid,
            // 'password' => $this->password,
            'qr' => $this->qr ?? $oldData->qr,
        ];
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}
