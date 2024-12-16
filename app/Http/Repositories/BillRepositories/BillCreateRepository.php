<?php
namespace App\Http\Repositories\BillRepositories;
use App\Http\Core\Repositories\CreateRepository;
use App\Models\Bill;

class BillCreateRepository extends CreateRepository
{
    public function __construct()
    {
        $this->model = new Bill();
    }
}