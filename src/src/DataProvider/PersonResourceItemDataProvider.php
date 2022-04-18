<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\PersonResource;
use App\DataMapper\PersonResourceDataMapper;
use App\Entity\Person;
use App\Repository\ClientRepository;
use App\Repository\PersonRepository;
use Doctrine\ORM\NonUniqueResultException;

class PersonResourceItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private PersonRepository $repository;
    private ClientRepository $clientRepository;

    public function __construct(PersonRepository $repository, ClientRepository $clientRepository)
    {
        $this->repository = $repository;
        $this->clientRepository = $clientRepository;
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
//      Could return entity, and use default normalizer, but for persistence (put/patch/delete) a entity instance will be passed to persister, instead of PersonResource instance
//        return $entity;
        return (new PersonResourceDataMapper($this->clientRepository))->mapToApiResource(PersonResource::class, $entity);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return PersonResource::class === $resourceClass;
    }
}