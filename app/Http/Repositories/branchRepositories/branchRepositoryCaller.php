<?php
namespace App\Http\Repositories\branchRepositories;

class branchRepositoryCaller{

    static public function createRepository(){return (new branchCreateRepository());}
    static public function readRepository(){return (new branchReadRepository());}
    static public function updateRepository(){return (new branchUpdateRepository());}
    static public function deleteRepository(){return (new branchDeleteRepository());}

}