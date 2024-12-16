<?php
namespace App\Http\Repositories\CategoryRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\Category;

class CategoryUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new Category();
    }

}