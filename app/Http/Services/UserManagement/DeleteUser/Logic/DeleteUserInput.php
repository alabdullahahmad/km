<?php
namespace App\Http\Services\UserManagement\DeleteUser\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class DeleteUserInput implements InputServiceInterface
{
    public function __construct( array $input)
    {}

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }
}