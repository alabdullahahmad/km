<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class Staf extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , HasRoles , InteractsWithMedia;

    protected $fillable = [
        'name',
        'phoneNumber',
        'password',
        'address',
        'isAdmin',
        'personalid',
        'gender',
        'birthDay',
        'status',
        'user_type'
    ];

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'isAdmin',
        'user_type'

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function scopeMyUsers($query,$type=''){
        $user = auth()->user();
        if($user->hasRole('admin') || $user->hasRole('demo_admin')) {
            if($type === 'get_provider'){
                $query->where('user_type', 'provider')->where('status',1);
            }
            if($type === 'get_customer'){
                $query->where('user_type', 'user');
            }
            return $query;
        }
        if($user->hasRole('provider')) {
            return $query->where('user_type', 'handyman')->where('provider_id',$user->id);
        }
    }
}
