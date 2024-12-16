<?php
namespace App\Http\Repositories\UserRepositories;

class UserRepositoryCaller{

    static public function createRepository(){return (new UserCreateRepository());}
    static public function readRepository(){return (new UserReadRepository());}
    static public function updateRepository(){return (new UserUpdateRepository());}
    static public function deleteRepository(){return (new UserDeleteRepository());}

}
