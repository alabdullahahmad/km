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
        'branchId',
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

    
        /**
         * Get the brand that owns the fund
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function branch()
        {
            return $this->belongsTo(Branch::class, 'branchId');
        }
}
