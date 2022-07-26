<?php

namespace App\Providers;

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
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Dispatch' => 'App\Policies\DispatchPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\Receiving' => 'App\Policies\ReceivingPolicy',
        'App\Models\Transaction' => 'App\Policies\TransactionPolicy',
        'App\Models\Vendor' => 'App\Policies\VendorPolicy',

        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
        'Spatie\Permission\Models\Permission' => 'App\Policies\PermissionPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Super Admin" role all permissions
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        // only if your Super Admin shouldn't be allowed to do things your app doesn't want "anyone" to do
        // Gate::after(function ($user, $ability) {
        //     return $user->hasRole('Super Admin'); // note this returns boolean
        //  });
    }
}
