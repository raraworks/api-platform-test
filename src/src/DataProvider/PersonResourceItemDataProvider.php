<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\PersonResource;
use App\Entity\Person;
use App\Repository\PersonRepository;
use Doctrine\ORM\NonUniqueResultException;

class PersonResourceItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private PersonRepository $repository;

    public function __construct(PersonRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): Person|null
    {
        $entity = $this->repository->createQueryBuilder('p')
            ->select('p, co, c')
            ->where('p.id = :id')
            ->leftJoin('p.clientObjects', 'co')
            ->leftJoin('p.clients', 'c')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        if (!$entity instanceof Person) {
            return null;
        }
        return $entity;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return PersonResource::class === $resourceClass;
    }
}