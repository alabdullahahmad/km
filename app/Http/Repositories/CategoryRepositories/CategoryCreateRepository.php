<?php
namespace App\Http\Repositories\CategoryRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\Category;

class CategoryCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new Category();
    }
}
