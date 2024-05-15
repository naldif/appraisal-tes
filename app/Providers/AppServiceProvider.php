<?php

namespace App\Providers;

use App\Models\Module;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
  
        View::composer('*', function($view)
        {
            $modules = Module::with(['menuitem'])->orderBy('sequence','asc')->get();

            $permissions = Permission::get();
 
            $view->with('modules', $modules);
            $view->with('permissions', $permissions);
        });
    } 
}
