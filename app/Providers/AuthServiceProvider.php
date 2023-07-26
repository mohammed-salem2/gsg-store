<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate::before(function($user , $ability){
        //     if($user->type == 'super-admin'){
        //         return true;
        //     }
        // });

        // foreach (Config('abilities') as $key => $value){
        //     Gate::define($key , function($user) use ($key){
        //         // $roles = Role::whereRaw('id IN (SELECT role_id FROM role_user WHERE user_id = ?)' , [
        //         //     $user->id ,
        //         // ])->get();
        //         // foreach ($roles as $role) {
        //         //     if(in_array($key , $role->abilities)){
        //         //         return true;
        //         //     }
        //         // }
        //         // return false;
        //         $user->hasAbility($key);
        //     });
        // }

        // Gate::define('products.create' , function($user) {
        //     return true ;
        // });
        // Gate::define('products.delete' , function($user) {
        //     return true ;
        // });
        // Gate::define('roles.index' , function($user) {
        //     return true ;
        // });
        // Gate::define('roles.create' , function($user) {
        //     return true ;
        // });
        // Gate::define('roles.update' , function($user) {
        //     return true ;
        // });
        // Gate::define('roles.delete' , function($user) {
        //     return true ;
        // });
    }
}
