<?php

namespace Hiworld\LaravelIot\Providers;

use Hiworld\LaravelIot\Contracts\IotProviderInterface;

class TuyaProvider implements IotProviderInterface
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    // 实现接口方法...
}