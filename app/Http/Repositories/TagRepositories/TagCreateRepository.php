<?php
namespace App\Http\Repositories\TagRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\Tag;

class TagCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new Tag();
    }
}
