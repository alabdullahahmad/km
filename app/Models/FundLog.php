<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundLog extends Model
{
    protected $fillable = [
        'stafId',
        'amount',
        'date',
        'adminRecipient',
        'stafRecipient',
    ];

    /**
     * Get the staf that owns the FundLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staf()
    {
        return $this->belongsTo(Staf::class, 'stafId');
    }
}
