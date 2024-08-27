<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\RolePolicy;
use App\Policies\Userpolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //USER MANAGEMENT--------------------------
        Gate::define("create_user",[Userpolicy::class,'create']);
        Gate::define("read_user",[Userpolicy::class,'view']);
        Gate::define("update_user",[Userpolicy::class,'update']);
        Gate::define("delete_user",[Userpolicy::class,'delete']);
        Gate::define("index_user",[Userpolicy::class,'index']);
        //ROLE MANAGEMENT--------------------------
        Gate::define("index_role",[RolePolicy::class,'index']);
        Gate::define("read_role",[RolePolicy::class,'view']);
        Gate::define("create_role",[RolePolicy::class,'create']);
        Gate::define("update_role",[RolePolicy::class,'update']);
        Gate::define("delete_role",[RolePolicy::class,'delete']);
        //
    }
}
