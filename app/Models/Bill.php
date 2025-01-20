<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'stafId',
        'payType',
        'date',
        'amount',
        'description',
        'discountAmount',
        'discountBecouse',
        'startDate',
        'endDate',
        'paymrentNote',
        'isCompletePayment',
        'coachId',
        'subscriptionId',
        'userId',
        'isEnd',
        'subscriptionCoachId',
        'branchId'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function staf()
    {
        return $this->belongsTo(Staf::class, 'stafId');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscriptionId');
    }

    /**
     * Get the coach that owns the Bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coachId');
    }

    /**
     * Get all of the userPayment for the Bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userPayment()
    {
        return $this->hasMany(UserPayment::class, 'billId' ,'id');
    }

    public function subscriptionCoach(){
        return $this->belongsTo(SubscriptionCoach::class,'subscriptionCoachId','id');
    }

    /**
     * Get the branch that owns the Bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branchId');
    }
}
