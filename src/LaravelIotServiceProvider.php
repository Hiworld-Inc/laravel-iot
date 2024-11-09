<?php

namespace Hiworld\LaravelIot;

use Illuminate\Support\ServiceProvider;
use Hiworld\LaravelIot\Contracts\IotProviderInterface;
use Hiworld\LaravelIot\Providers\CtwingProvider;
use Hiworld\LaravelIot\IotFactory;

class LaravelIotServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-iot.php', 'laravel-iot');

        // 注册 IoT Factory
        $this->app->singleton('iot', function ($app) {
            $config = config('laravel-iot.providers.ctwing');
            return new CtwingProvider($config);  // 直接返回 CtwingProvider 实例
        });

        // 绑定接口到默认实现
        $this->app->bind(IotProviderInterface::class, function ($app) {
            return app('iot');  // 使用同一个实例
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-iot.php' => config_path('laravel-iot.php'),
        ], 'laravel-iot-config');
    }


    // public function register()
    // {
    //     $this->mergeConfigFrom(__DIR__.'/../config/laravel-iot.php', 'laravel-iot');

    //     // 注册 IoT Factory
    //     $this->app->singleton('iot', function ($app) {
    //         return new IotFactory($app['config']['laravel-iot']);
    //     });

    //     // 绑定接口到默认实现
    //     $this->app->bind(IotProviderInterface::class, function ($app) {
    //         $config = config('laravel-iot.providers.ctwing');
    //         return new CtwingProvider($config);
    //     });
    // }

    // public function boot()
    // {
    //     $this->publishes([
    //         __DIR__.'/../config/laravel-iot.php' => config_path('laravel-iot.php'),
    //     ], 'laravel-iot-config');
    // }
}