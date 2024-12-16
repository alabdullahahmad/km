<?php
namespace App\Http\Repositories\DiscountsRepositories;
use App\Http\Core\Repositories\ReadRepository;
use App\Models\Discounts;

class DiscountsReadRepository extends ReadRepository
{
    public function __construct()
    {
        $this->model = new Discounts();
    }

}