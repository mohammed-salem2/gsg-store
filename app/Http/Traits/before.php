<?php
namespace App\Http\Traits;
use App\Models\User;

trait before
{
    public function before(User $user , $ability)
    {
        if($user->type == 'super-admin'){
            return true;
        }
    }
}
