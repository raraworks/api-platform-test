<?php

namespace App\DataProvider;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator as ApiPlatformPaginator;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\Pagination;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\ClientResource;
use App\Repository\ClientRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ClientResourceCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    protected ClientRepository $repository;
    protected Pagination $pagination;

    public function __construct(ClientRepository $repository, Pagination $pagination)
    {
        $this->repository = $repository;
        $this->pagination = $pagination;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        [, $offset, $limit] = $this->pagination->getPagination($resourceClass, $operationName, $context);
        $query = $this->repository->createQueryBuilder('c')
            ->select('c, p')
            ->leftJoin('c.person', 'p')
            ->getQuery()
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        return new ApiPlatformPaginator(new Paginator($query, true));

    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return ClientResource::class === $resourceClass;
    }
}