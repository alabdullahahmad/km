<?php
namespace App\Http\Repositories\PalyerLoginLogRepositories;

class PalyerLoginLogRepositoryCaller{

    static public function createRepository(){return (new PalyerLoginLogCreateRepository());}
    static public function readRepository(){return (new PalyerLoginLogReadRepository());}
    static public function updateRepository(){return (new PalyerLoginLogUpdateRepository());}
    static public function deleteRepository(){return (new PalyerLoginLogDeleteRepository());}

}