<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'admin_data',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin_data' => 'array',
    ];

    public function roles()
    {
        return $this->belongsToMany(
            Role::class ,
            'role_user',
            'role_id',
            'user_id',
            'id',
            'id',
        );
    }

    public function country()
    {
        return $this->belongsTo(Country::class , 'country_id' , 'id')->withDefault([
            'name' => 'No Country' ,
            ]);
    }

    public function products()
    {
        return $this->hasMany(Product::class , 'user_id' , 'id');
    }

    public function ratings()
    {
        return $this->morphMany(Rate::class , 'rateable' , 'rateable_type' , 'rateable_id' ,'id');
    }

    public function hasAbility($ability)
    {
        $roles = Role::whereRaw('id IN (SELECT role_id FROM role_user WHERE user_id = ?)' , [
            $this->id ,
        ])->get();
        foreach ($roles as $role) {
            if(in_array($ability , $role->abilities)){
                return true;
            }
        }
        return false;
    }
}
