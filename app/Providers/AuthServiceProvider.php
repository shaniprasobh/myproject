<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        // Allow AdminLTE menu 'can' => 'role:Super Admin|Manager' to work
        Gate::before(function ($user, $ability) {
            if (strpos($ability, 'role:') === 0) {
                $roles = explode('|', str_replace('role:', '', $ability));
                return $user->hasAnyRole($roles);
            }
        });
    }
}
