<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fund extends Model
{
        /** @use HasFactory<\Database\Factories\UserFactory> */
        use HasFactory;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'amount',
            // 'branchId',
        ];

        /**
         * Get the brand that owns the fund
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        // public function branch()
        // {
        //     return $this->belongsTo(Branch::class, 'branchId');
        // }
}
