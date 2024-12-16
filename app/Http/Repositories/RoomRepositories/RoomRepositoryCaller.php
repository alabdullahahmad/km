<?php
namespace App\Http\Repositories\RoomRepositories;

class RoomRepositoryCaller{

    static public function createRepository(){return (new RoomCreateRepository());}
    static public function readRepository(){return (new RoomReadRepository());}
    static public function updateRepository(){return (new RoomUpdateRepository());}
    static public function deleteRepository(){return (new RoomDeleteRepository());}

}
