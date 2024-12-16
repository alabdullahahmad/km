<?php
namespace App\Http\Repositories\CategoryRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\Category;

class CategoryDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new Category();
    }
}
