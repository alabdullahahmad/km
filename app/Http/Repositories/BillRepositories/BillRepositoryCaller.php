<?php
namespace App\Http\Repositories\BillRepositories;

class BillRepositoryCaller{

    static public function createRepository(){return (new BillCreateRepository());}
    static public function readRepository(){return (new BillReadRepository());}
    static public function updateRepository(){return (new BillUpdateRepository());}
    static public function deleteRepository(){return (new BillDeleteRepository());}

}
