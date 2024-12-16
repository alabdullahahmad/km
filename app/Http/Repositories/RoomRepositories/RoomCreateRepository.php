<?php
namespace App\Http\Repositories\RoomRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\Room;

class RoomCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new Room();
    }
}
