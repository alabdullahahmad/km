<?php
namespace App\Http\Repositories\TagRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\Tag;

class TagDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new Tag();
    }
}
