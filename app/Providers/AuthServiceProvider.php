<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
            if ($user->role->name == 'Admin') {
                return true;
            }
        });

        Gate::define('admin-login', function (User $user) {
            if ($user->role->name == 'Writer') {
                return true;
            }
        });

        Gate::define('admin-only', function (User $user) {
            if ($user->role->name == 'Admin') {
                return true;
            }
        });
    }
}
