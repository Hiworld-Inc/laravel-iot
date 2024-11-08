<?php

namespace Hiworld\LaravelIot\Contracts;

interface IotProviderInterface
{
    public function getDevices(): array;
    public function getDevice(string $deviceId): array;
    public function createDevice(array $data): array;
    public function deleteDevice(string $deviceId): bool;
    public function updateDevice(string $deviceId, array $data): array;
    public function sendCommand(array $command, array $options = []): array;
    public function getProperties(string $deviceId): array;
    public function getEvents(string $deviceId): array;
}