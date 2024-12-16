<?php
namespace App\Http\Repositories\RoomRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\Room;

class RoomUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new Room();
    }

}
