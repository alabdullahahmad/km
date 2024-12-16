<?php
namespace App\Http\Repositories\DiscountsRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\Discounts;

class DiscountsUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new Discounts();
    }

}