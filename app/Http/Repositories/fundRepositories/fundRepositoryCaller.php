<?php
namespace App\Http\Repositories\fundRepositories;

class fundRepositoryCaller{

    static public function createRepository(){return (new fundCreateRepository());}
    static public function readRepository(){return (new fundReadRepository());}
    static public function updateRepository(){return (new fundUpdateRepository());}
    static public function deleteRepository(){return (new fundDeleteRepository());}

}