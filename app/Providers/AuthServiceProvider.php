<?php

namespace App\Providers;


use App\Enums\EnumTrait;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    use EnumTrait;
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization service.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            return $user->role === UserStatus::ADMIN->value;
        });
    }
}
