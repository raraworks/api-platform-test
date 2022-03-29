<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\ServiceResource;

class ServiceResourceCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, string $operationName = null): iterable
    {
        $service = new ServiceResource(id: 1, title: 'Service 1', slug: 'service-1', description: 'Service 1 description', position: 1, createdAt: new \DateTimeImmutable(), updatedAt: new \DateTimeImmutable());
        return [$service];
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return ServiceResource::class === $resourceClass;
    }

}