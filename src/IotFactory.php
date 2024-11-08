<?php

namespace Hiworld\LaravelIot;

use Hiworld\LaravelIot\Contracts\IotProviderInterface;  // 更新接口引用
use Hiworld\LaravelIot\Providers\CtwingProvider;
use InvalidArgumentException;

class IotFactory
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * 获取指定的IoT提供商实例
     *
     * @param string|null $name
     * @return IotProviderInterface
     * @throws InvalidArgumentException
     */
    public function provider(string $name = null): IotProviderInterface  // 更新返回类型
    {
        $name = $name ?: $this->config['default'];
        
        if (!isset($this->config['providers'][$name])) {
            throw new InvalidArgumentException("IoT provider [{$name}] not configured.");
        }

        $config = $this->config['providers'][$name];

        return match($name) {
            'ctwing' => new CtwingProvider($config),
            default => throw new InvalidArgumentException("Unsupported IoT provider [{$name}]"),
        };
    }
}