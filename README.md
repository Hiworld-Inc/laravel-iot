# Laravel IoT Package

一个用于物联网设备管理的 Laravel 扩展包，支持设备指令下发等功能。

## 安装

你可以通过 Composer 安装此扩展包：


```bash
composer require hiworld/laravel-iot
```


安装完成后，如果你使用的是 Laravel 5.5 以下版本，需要在 `config/app.php` 中注册服务提供者：

```php
'providers' => [
    // ...
    Hiworld\LaravelIot\IotServiceProvider::class,
];
```

3. 配置

```bash
php artisan vendor:publish --provider="Hiworld\LaravelIot\IotServiceProvider"

```


