<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PalyerLoginLog extends Model
{

    protected $fillable = [
        'userId', 'date','subscriptionName' , 'loginFiled'
    ];

    /**
     * Get the user that owns the PalyerLoginLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
