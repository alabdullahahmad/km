<?php
namespace App\Http\Repositories\FundLogRepositories;

class FundLogRepositoryCaller{

    static public function createRepository(){return (new FundLogCreateRepository());}
    static public function readRepository(){return (new FundLogReadRepository());}
    static public function updateRepository(){return (new FundLogUpdateRepository());}
    static public function deleteRepository(){return (new FundLogDeleteRepository());}

}