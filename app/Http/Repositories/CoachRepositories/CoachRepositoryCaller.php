<?php
namespace App\Http\Repositories\CoachRepositories;

class CoachRepositoryCaller{

    static public function createRepository(){return (new CoachCreateRepository());}
    static public function readRepository(){return (new CoachReadRepository());}
    static public function updateRepository(){return (new CoachUpdateRepository());}
    static public function deleteRepository(){return (new CoachDeleteRepository());}

}
