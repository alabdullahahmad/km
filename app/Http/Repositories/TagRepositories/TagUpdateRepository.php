<?php
namespace App\Http\Repositories\TagRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\Tag;

class TagUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new Tag();
    }

}
