<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('direktor', function (User $user, $company_id = null, Employee $employee = null) {
            return $user->isCompany() &&
                ($user->company_id == $company_id ||
                    $user->company_id == $employee->company_id);
        });
    }
}
