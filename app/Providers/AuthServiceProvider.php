<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\MarketAutomobile;' 	=> 'App\Policies\MarketAutomobilePolicy',
        'App\MarketMotorcycle' 	=> 'App\Policies\MarketMotorcyclePolicy',
        'App\MarketTruck' 		=> 'App\Policies\MarketTruckPolicy',
        'App\MarketParts' 		=> 'App\Policies\MarketPartsPolicy',
        'App\MarketEquipment' 	=> 'App\Policies\MarketEquipmentPolicy',
        'App\Gallery' 			=> 'App\Policies\GalleryPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
