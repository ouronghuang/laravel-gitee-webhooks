<?php

namespace Orh\LaravelGiteeWebhooks;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Orh\LaravelGiteeWebhooks\Http\Middleware\Verify;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/gitee-webhooks.php' => config_path('gitee-webhooks.php'),
            ], 'gitee-webhooks-config');
        }

        Route::group([
            'prefix' => config('gitee-webhooks.prefix'),
            'namespace' => 'Orh\LaravelGiteeWebhooks\Http\Controllers',
            'middleware' => [
                'web',
                Verify::class,
            ],
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/gitee-webhooks.php', 'gitee-webhooks');
    }
}
