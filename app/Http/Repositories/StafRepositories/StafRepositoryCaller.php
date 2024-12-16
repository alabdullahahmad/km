<?php
namespace App\Http\Repositories\StafRepositories;

class StafRepositoryCaller{

    static public function createRepository(){return (new StafCreateRepository());}
    static public function readRepository(){return (new StafReadRepository());}
    static public function updateRepository(){return (new StafUpdateRepository());}
    static public function deleteRepository(){return (new StafDeleteRepository());}

}