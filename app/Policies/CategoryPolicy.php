<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Http\Traits\before;

class CategoryPolicy
{
    use before;
    // public function before(User $user , $ability)
    // {
    //     if($user->type == 'super-admin'){
    //         return true;
    //     }
    // }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAbility('categories.index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        return $user->hasAbility('categories.show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAbility('categories.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->hasAbility('categories.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->hasAbility('categories.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
        return $user->hasAbility('categories.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return $user->hasAbility('categories.force-delete');

    }
}
