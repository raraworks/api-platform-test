<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\PersonResource;
use App\Repository\PersonRepository;

class PersonResourceCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    protected PersonRepository $repository;

    public function __construct(PersonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        //find entities
        $collection = $this->repository->findAll();
        //normalize collection items to resource with the help of mapper
        foreach ($collection as &$entity) {
            $resource = new PersonResource();
            $resource->id = $entity->getId();
            $resource->fullName = "{$entity->getFirstName()} {$entity->getLastName()}";
            $resource->email = $entity->getEmail();
            $resource->phoneNo = $entity->getPhoneNo();
            $resource->createdAt = $entity->getCreatedAt();
            $resource->updatedAt = $entity->getUpdatedAt();
            $entity = $resource;
        }
        //use default encoder logic for the paginator instance
        return $collection;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return PersonResource::class === $resourceClass;
    }
}