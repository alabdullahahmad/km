<?php
namespace App\Http\Repositories\RoomRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\Room;

class RoomDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new Room();
    }
}
