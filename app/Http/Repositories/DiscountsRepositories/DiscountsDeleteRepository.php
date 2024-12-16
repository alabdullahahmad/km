<?php
namespace App\Http\Repositories\DiscountsRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\Discounts;

class DiscountsDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new Discounts();
    }
}