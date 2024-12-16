<?php
namespace App\Http\Repositories\TagRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\Tag;

class TagReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new Tag();
    }

}
