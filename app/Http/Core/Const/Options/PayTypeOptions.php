<?php
namespace App\Http\Core\Const\Options;


enum PayTypeOptions : string{

    case In = "in";
    case Out = "out";

    static function getAll(){
        return array_map(fn($status) => $status->value, PayTypeOptions::cases());
    }
}



