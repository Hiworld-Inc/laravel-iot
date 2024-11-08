<?php

namespace Hiworld\LaravelIot\Providers;

use Hiworld\LaravelIot\Contracts\IotProviderInterface;
use Hiworld\LaravelIot\Core\AepSdkCore;
use InvalidArgumentException;
class CtwingProvider implements IotProviderInterface
{
    protected $baseUrl;
    protected $appKey;
    protected $secret;

    public function __construct(array $config)
    {
        // 检查必需的配置项
        $requiredConfig = ['base_url','time_url', 'app_key', 'app_secret'];
        foreach ($requiredConfig as $key) {
            if (!isset($config[$key])) {
                throw new InvalidArgumentException("Missing required configuration key: {$key}");
            }
        }

        $this->baseUrl = $config['base_url'];
        $this->timeUrl = $config['time_url'];
        $this->appKey = $config['app_key'];
        $this->secret = $config['app_secret'];
        
        // 初始化SDK核心
        AepSdkCore::init([
            'base_url' => $this->baseUrl,
            'time_url' => $this->timeUrl,
            'app_key' => $this->appKey,
            'secret' => $this->secret,
        ]);
    }
    /**
     * 获取设备列表
     *
     * @return array
     */
    public function getDevices(): array
    {
        $path = '/aep_product_management/devices';
        $response = AepSdkCore::sendSDkRequest(
            $path,
            null,
            [],
            null,
            '',
            $this->appKey,
            $this->secret,
            'GET'
        );

        return json_decode($response, true) ?? [];
    }

    /**
     * 获取设备详情
     *
     * @param string $deviceId
     * @return array
     */
    public function getDevice(string $deviceId): array
    {
        $path = '/aep_product_management/device';
        $params = ['deviceId' => $deviceId];
        
        $response = AepSdkCore::sendSDkRequest(
            $path,
            null,
            $params,
            null,
            $this->version,
            $this->appKey,
            $this->secret,
            'GET'
        );

        return json_decode($response, true) ?? [];
    }

    /**
     * 创建设备
     *
     * @param array $data
     * @return array
     */
    public function createDevice(array $data): array
    {
        $path = '/aep_product_management/device';
        
        $response = AepSdkCore::sendSDkRequest(
            $path,
            null,
            null,
            json_encode($data),
            $this->version,
            $this->appKey,
            $this->secret,
            'POST'
        );

        return json_decode($response, true) ?? [];
    }

    /**
     * 删除设备
     *
     * @param string $deviceId
     * @return bool
     */
    public function deleteDevice(string $deviceId): bool
    {
        $path = '/aep_product_management/device';
        $params = ['deviceId' => $deviceId];

        $response = AepSdkCore::sendSDkRequest(
            $path,
            null,
            $params,
            null,
            $this->version,
            $this->appKey,
            $this->secret,
            'DELETE'
        );

        $result = json_decode($response, true);
        return isset($result['code']) && $result['code'] === 0;
    }

    /**
     * 更新设备
     *
     * @param string $deviceId
     * @param array $data
     * @return array
     */
    public function updateDevice(string $deviceId, array $data): array
    {
        $path = '/aep_product_management/device';
        $params = ['deviceId' => $deviceId];
        
        $response = AepSdkCore::sendSDkRequest(
            $path,
            null,
            $params,
            json_encode($data),
            $this->version,
            $this->appKey,
            $this->secret,
            'PUT'
        );
        return json_decode($response, true) ?? [];
    }

   /**
     * 发送命令到设备
     *
     * @param array $command 命令内容
     * @param array $options 可选参数，包含 path, params, version, headers 等
     * @return array
     */
    public function sendCommand(array $command, array $options = []): array
    {
        // 默认值与自定义值合并
        $options = array_merge([
            'path' => '',
            'params' => '',
            'version' => '',
            'headers' => '',
            'contentType' => 'application/json',
        ], $options);

        $response = AepSdkCore::sendSDkRequest(
            $options['path'],
            $options['headers'],
            $options['params'],
            json_encode($command),
            $options['version'],
            $this->appKey,
            $this->secret,
            'POST'
        );

        return json_decode($response, true) ?? [];
    }

    /**
     * 获取设备属性
     *
     * @param string $deviceId
     * @return array
     */
    public function getProperties(string $deviceId): array
    {
        $path = '/aep_device_status/getProperties';
        $params = ['deviceId' => $deviceId];
        
        $response = AepSdkCore::sendSDkRequest(
            $path,
            null,
            $params,
            null,
            $this->version,
            $this->appKey,
            $this->secret,
            'GET'
        );

        return json_decode($response, true) ?? [];
    }

    /**
     * 获取设备事件
     *
     * @param string $deviceId
     * @return array
     */
    public function getEvents(string $deviceId): array
    {
        $path = '/aep_device_event/events';
        $params = ['deviceId' => $deviceId];
        
        $response = AepSdkCore::sendSDkRequest(
            $path,
            null,
            $params,
            null,
            $this->version,
            $this->appKey,
            $this->secret,
            'GET'
        );

        return json_decode($response, true) ?? [];
    }
}