<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\ServiceResource;

class ServiceResourceItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ServiceResource|null
    {
        if ($id === '1') {
            return new ServiceResource(id: 1, title: 'Service 1', slug: 'service-1', description: 'Service 1 description', position: 1, createdAt: new \DateTimeImmutable(), updatedAt: new \DateTimeImmutable());
        }
        return null;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return ServiceResource::class === $resourceClass;
    }
}