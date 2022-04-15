<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\PersonResource;
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
        //normalize to array with the help of mapper
        $return = new PersonResource();
        $return->id = $entity->getId();
        $return->fullName = "{$entity->getFirstName()} {$entity->getLastName()}";
        $return->email = $entity->getEmail();
        $return->phoneNo = $entity->getPhoneNo();
        $return->createdAt = $entity->getCreatedAt();
        $return->updatedAt = $entity->getUpdatedAt();
        //use default encoder logic
        return $return;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return PersonResource::class === $resourceClass;
    }
}