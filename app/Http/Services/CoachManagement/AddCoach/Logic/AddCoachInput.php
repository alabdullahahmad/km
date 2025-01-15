<?php
namespace App\Http\Services\CoachManagement\AddCoach\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;
use Illuminate\Support\Facades\Hash;

class AddCoachInput implements InputServiceInterface
{
    public $photo;
    public ?string $name;
    // public string $password;
    public string $phoneNumber;
    public ?string $address;
    // public ?string $personalid;
    public string $gender;
    public ?string $birthDay;
    public int $percentage;
    public array $class;
    public int $branchId;

    public function __construct( $input)
    {
        $this->photo = $input->file('photo');
        $this->name = $input->name;
        // $this->password = $input->password;
        $this->phoneNumber = $input->phoneNumber;
        $this->address = $input->address ?? '';
        // $this->personalid = $input->personalid;
        $this->gender = $input->gender;
        $this->birthDay = $input->birthDay;
        $this->percentage = $input->percentage;
        $this->class = $input->class;
        $this->branchId = $input->branchId;
    }

    // write your input function here..

    public function toArray( ?string $oldPath = null){
        return [
            'name' => $this->name,
            // 'password' => Hash::make($this->password),
            'photo' => $this->getPhoto($oldPath),
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            // 'personalid' => $this->personalid,
            'gender' => $this->gender,
            'birthDay'=>$this->birthDay,
            'percentage'=>$this->percentage,
            'class'=>$this->getClass(),
            'branchId' => $this->branchId
        ];
    }

    /**
     * Get the value of photo
     */
    public function getPhoto( ?string $oldPath = null)
    {
        return ($this->photo)?storeImage($this->photo,"coache/profile",$oldPath):null;
    }

    /**
     * Get the value of class
     */
    public function getClass()
    {
        return json_encode($this->class);
    }
}
