<?php
namespace App\Http\Repositories\BillLogRepositories;
use App\Models\{BillLog};

class BillLogRepositoryCaller{

    static public function createRepository(){return (new BillLogCreateRepository());}
    static public function readRepository(){return (new BillLogReadRepository());}
    static public function updateRepository(){return (new BillLogUpdateRepository());}
    static public function deleteRepository(){return (new BillLogDeleteRepository());}
    static public function get_model() : BillLog {return (new BillLog());}


}