<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\ClientResource;
use App\DataMapper\ClientResourceDataMapper;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\NonUniqueResultException;

class ClientResourceItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private ClientRepository $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ClientResource|null
    {
        $entity = $this->repository->createQueryBuilder('c')
            ->select('c, p')
            ->where('c.id = :id')
            ->leftJoin('c.person', 'p')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        if (!$entity instanceof Client) {
            return null;
        }
//      Could return entity, and use default normalizer, but for persistence (put/patch/delete) a entity instance will be passed to persister, instead of PersonResource instance
//        return $entity;
        return (new ClientResourceDataMapper())->mapToApiResource(ClientResource::class, $entity);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return ClientResource::class === $resourceClass;
    }
}