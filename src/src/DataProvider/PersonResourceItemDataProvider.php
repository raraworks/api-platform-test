<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\PersonResource;
use App\DataMapper\PersonResourceDataMapper;
use App\Entity\Person;
use App\Repository\PersonRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;

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
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): PersonResource|null
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
        //TODO: create mapper service that returns populated/hydrated resource POPO, to pass to default serializer (normalizer/encoder process)
        return (new PersonResourceDataMapper())->mapToApiResource(PersonResource::class, $entity);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return PersonResource::class === $resourceClass;
    }
}