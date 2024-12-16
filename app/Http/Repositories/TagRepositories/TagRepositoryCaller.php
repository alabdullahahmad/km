<?php
namespace App\Http\Repositories\TagRepositories;

class TagRepositoryCaller{

    static public function createRepository(){return (new TagCreateRepository());}
    static public function readRepository(){return (new TagReadRepository());}
    static public function updateRepository(){return (new TagUpdateRepository());}
    static public function deleteRepository(){return (new TagDeleteRepository());}

}
