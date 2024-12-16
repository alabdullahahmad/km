<?php
namespace App\Http\Core\Const\Options;

enum ResponseCode : int{
    case InValiedData = 422;
    case Success = 200;
    case Redirect = 302;
    case Exception = 500;
    case NotFound = 404;
}
