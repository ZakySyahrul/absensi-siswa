<?php

namespace App\Providers;

use App\Models\User;
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
        Gate::define('admin', function(User $user ){
           return $user->role === 'Admin';
        });
        
        Gate::define('guru', function(User $user ){
            return $user->role === 'Guru';
         });

         Gate::define('kedis', function(User $user){
            return $user->role === 'Kedisiplinan';
         });
    }
}