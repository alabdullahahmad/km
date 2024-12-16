<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
        /** @use HasFactory<\Database\Factories\UserFactory> */
        use HasFactory;

        protected $fillable = [
            'id',
            'tagId',
            'categoryId',
            'name',
            'price',
            'numOfDays',
            'numOfSessions',
            'description',
        ];

            /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        // protected $hidden = [
        //     'tagId',
        //     'categoryId',
        // ];

        /**
         * Get the tag that owns the Subscription
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function tag()
        {
            return $this->belongsTo(Tag::class, 'tagId');
        }

        /**
         * Get the category that owns the Subscription
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function category()
        {
            return $this->belongsTo(Category::class, 'categoryId');
        }

        /**
         * Get all of the calander for the Subscription
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function calander()
        {
            return $this->hasMany(SubscriptionCoach::class, 'foreign_key', 'local_key');
        }
}
