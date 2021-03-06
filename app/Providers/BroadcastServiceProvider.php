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
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::channel('App.User.*', function ($user, $userId) {
            return (int) $user->id === (int) $userId;
        });

        Broadcast::channel('status.doing.user', function ($user, $userId) {
            return true;

            // $user->id === Order::findOrNew($orderId)->user_id;
            // aqui validar que quien escuche la notificacion sean solo los
            //spuervisores que tiene a su custodia a vendedores
        });
    }
}
