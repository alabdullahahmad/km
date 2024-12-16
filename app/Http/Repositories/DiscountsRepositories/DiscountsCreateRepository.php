<?php
namespace App\Http\Repositories\DiscountsRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\Discounts;

class DiscountsCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new Discounts();
    }
}