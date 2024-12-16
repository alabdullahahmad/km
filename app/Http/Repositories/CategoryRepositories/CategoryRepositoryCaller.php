<?php
namespace App\Http\Repositories\CategoryRepositories;

class CategoryRepositoryCaller{

    static public function createRepository(){return (new CategoryCreateRepository());}
    static public function readRepository(){return (new CategoryReadRepository());}
    static public function updateRepository(){return (new CategoryUpdateRepository());}
    static public function deleteRepository(){return (new CategoryDeleteRepository());}

}