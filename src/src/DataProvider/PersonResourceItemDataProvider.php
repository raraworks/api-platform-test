<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\PersonResource;
use App\DataMapper\PersonResourceDataMapper;
use App\Entity\Person;
use App\Repository\PersonRepository;

class PersonResourceItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private PersonRepository $repository;

    public function __construct(PersonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): PersonResource|null
    {
        //find entity
        $entity = $this->repository->find($id);
        if (!$entity instanceof Person) {
            return null;
        }
        foreach ($entity->getClientObjects() as $clientObject) {
            $entity->addClientObject($clientObject);
        }
        //TODO: create mapper service that returns populated/hydrated resource POPO, to pass to default serializer (normalizer/encoder process)
        return (new PersonResourceDataMapper())->mapToApiResource(PersonResource::class, $entity);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return PersonResource::class === $resourceClass;
    }
}