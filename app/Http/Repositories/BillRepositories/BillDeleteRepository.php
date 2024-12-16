<?php
namespace App\Http\Repositories\BillRepositories;
use App\Http\Core\Repositories\DeleteRepository;
use App\Models\Bill;

class BillDeleteRepository extends DeleteRepository
{
    public function __construct()
    {
        $this->model = new Bill();
    }
}