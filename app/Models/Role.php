<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'abilities', 'admin_data',
    ];

    protected $casts = [
        'admin_data' => 'array' ,
        'abilities' => 'array' ,
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class ,
            'role_user',
            'role_id',
            'user_id',
            'id',
            'id',
        );
    }
}
