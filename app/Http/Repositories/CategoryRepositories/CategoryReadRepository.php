<?php
namespace App\Http\Repositories\CategoryRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\Category;

class CategoryReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new Category();
    }

}