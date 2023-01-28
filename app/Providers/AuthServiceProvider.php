<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Apartment;
use App\Models\User;
use App\Policies\ApartmentPolicy;
use Illuminate\Auth\Access\Response;
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
        Apartment::class => ApartmentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::define('can-make-offer', function (User $user, Apartment $apartment) {
//            return $apartment->sold_at === null;
//        });
    }
}
