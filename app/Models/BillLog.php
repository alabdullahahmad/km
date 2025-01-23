<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillLog extends Model
{
    
    protected $fillable = [
        'subscriptionDateModified',
        'stafId',
        'startDateAfterEdit',
        'isTypeModified',
        'subscriptionBeforeEdit',
        'subscriptionAfterEdit',
        'billId'
    ];

    /**
     * Get the staf that owns the BillLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staf()
    {
        return $this->belongsTo(Staf::class, 'stafId');
    }

    /**
     * Get the user that owns the BillLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription_befor()
    {
        return $this->belongsTo(Subscription::class, 'subscriptionBeforeEdit');
    }

        /**
     * Get the user that owns the BillLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription_after()
    {
        return $this->belongsTo(Subscription::class, 'subscriptionAfterEdit');
    }


}
