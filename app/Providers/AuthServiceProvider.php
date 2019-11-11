<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Passport 
        Passport::routes();

        Passport::tokensCan([
            'access-route1' => 'Can Access Route 1',
            'access-route2' => 'Can Access Route 2',
            'create-user' => 'Can Create User',
            'edit-user' => 'Can Edit user',
            'view-user' => 'Can View user',
            'delete-user' => 'Can Delete user',

        ]);

        /**
         * Uncomment the below code to set custom
         * token life span
         */ 
        
        /*   
        Passport::tokensExpireIn(now()->addDays(15));

        Passport::refreshTokensExpireIn(now()->addDays(30));

        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        */

    }
}
