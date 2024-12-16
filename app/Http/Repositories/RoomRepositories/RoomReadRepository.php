<?php
namespace App\Http\Repositories\RoomRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\Room;

class RoomReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new Room();
    }

}
