<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Log::info('BroadcastServiceProvider booted');
        Broadcast::routes(
            ['middleware' => ['web', 'auth:sanctum']]
        );

        require base_path('routes/channels.php');
    }
}
