<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StafLoging extends Model
{
    use HasFactory;

    protected $fillable = [
        'stafId',
        'enterTime',
        'exitTime',
        'date'
    ];
    public function staf(){
        return $this->belongsTo(Staf::class, 'stafId');
    }


}
