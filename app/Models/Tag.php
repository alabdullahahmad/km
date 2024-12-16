<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
        /** @use HasFactory<\Database\Factories\UserFactory> */
        use HasFactory;

        protected $fillable = [
            'name',
            'categoryId'
        ];

            /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        // protected $hidden = [
        //     'categoryId',
        // ];

        /**
         * Get the category that owns the Tag
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function category()
        {
            return $this->belongsTo(Category::class, 'categoryId');
        }
}
