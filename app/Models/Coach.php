<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'photo',
        'name',
        'phoneNumber',
        'address',
        'personalid',
        'gender',
        'birthDay',
        'percentage',
        'password',
        'class',
        'branchId'
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * Get all of the calander for the Coach
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function calander()
    {
        return $this->hasMany(SubscriptionCoach::class, 'coachId');
    }

    /**
     * Get the branch that owns the Coach
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branchId');
    }
}
