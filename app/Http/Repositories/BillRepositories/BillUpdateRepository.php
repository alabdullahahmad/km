<?php
namespace App\Http\Repositories\BillRepositories;
use App\Http\Core\Repositories\UpdateRepository;
use App\Models\Bill;

class BillUpdateRepository extends UpdateRepository
{
    public function __construct()
    {
        $this->model = new Bill();
    }

}