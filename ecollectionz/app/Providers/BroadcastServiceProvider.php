<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            Broadcast::routes(['middleware' => 'auth:admin']);
            Broadcast::channel('App.User.{id}', function ($user, $id) {
                return (int) $user->id === (int) $id;
        });
    }
}
