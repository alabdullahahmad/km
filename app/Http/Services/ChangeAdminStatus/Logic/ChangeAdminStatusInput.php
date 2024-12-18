<?php
namespace App\Http\Services\ChangeAdminStatus\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ChangeAdminStatusInput implements InputServiceInterface
{
    public int $stafId;
    public bool $isAdmin;
    public function __construct( array $input)
    {
        $this->stafId = $input['stafId'];
        $this->isAdmin = $input['isAdmin'];
    }

    // write your input function here..

    public function toArray(){
        return [
            'stafId' => $this->stafId,
            'isAdmin' => $this->isAdmin
        ];
    }
}
