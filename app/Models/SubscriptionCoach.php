<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// this is for calendar not SubscriptionCoach
class SubscriptionCoach extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $fillable = [
        'subscriptionId',
        'coachId',
        'roomId',
        'fromHouer',
        'toHouer',
        'period',
        'dayOfWeek'
    ];

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'subscriptionId',
    //     'coachId',
    //     'roomId',
    // ];

    /**
     * Get the tag that owns the Subscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'roomId');
    }

    /**
     * Get the category that owns the Subscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coachId');
    }

        /**
     * Get the category that owns the Subscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscriptionId');
    }
}
