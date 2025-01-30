<?php
namespace App\Http\Services\CoachManagement\EditeCoach\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;
use Illuminate\Support\Facades\Hash;

class EditeCoachInput implements InputServiceInterface
{
    public int $coacheId;
    public $photo;
    public ?string $name;
    public ?string $address;
    // public ?string $personalid;
    public string $gender;
    public ?string $birthDay;
    public int $percentage;
    public ?array $class;
    public int $branchId;

    public function __construct( $input)
    {
        $this->coacheId = $input->coacheId;
        $this->photo = $input->file('photo');
        $this->name = $input->name;
        $this->address = $input->address;
        // $this->personalid = $input->personalid;
        $this->gender = $input->gender;
        $this->birthDay = $input->birthDay;
        $this->percentage = $input->percentage;
        $this->class = $input->class ?? null;
        $this->branchId = $input->branchId;
    }

    // write your input function here..

    public function toArray(){
        return [
            'name' => $this->name,
            'address' => $this->address,
            // 'personalid' => $this->personalid,
            'gender' => $this->gender,
            'birthDay'=>$this->birthDay,
            'percentage'=>$this->percentage,
            'branchId' => $this->branchId
        ];
    }

    /**
     * Get the value of photo
     */
    public function getPhoto( ?string $oldPath = null)
    {
        return storeImage($this->photo,"coache/profile",$oldPath);
    }

    /**
     * Get the value of coacheId
     */
    public function getCoacheId()
    {
        return $this->coacheId;
    }

    /**
     * Set the value of coacheId
     *
     * @return  self
     */
    public function setCoacheId($coacheId)
    {
        $this->coacheId = $coacheId;

        return $this;
    }

    public function getClass()
    {
        return json_encode($this->class);
    }
}
