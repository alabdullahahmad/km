<?php
namespace App\Http\Repositories\DiscountsRepositories;

class DiscountsRepositoryCaller{

    static public function createRepository(){return (new DiscountsCreateRepository());}
    static public function readRepository(){return (new DiscountsReadRepository());}
    static public function updateRepository(){return (new DiscountsUpdateRepository());}
    static public function deleteRepository(){return (new DiscountsDeleteRepository());}

}