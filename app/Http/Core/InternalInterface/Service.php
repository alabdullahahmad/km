<?php
namespace App\Http\Core\InternalInterface;

use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

interface Service  {
    public function execute () : ResponseModel;
}
