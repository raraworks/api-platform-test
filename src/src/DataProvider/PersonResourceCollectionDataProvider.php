<?php

namespace App\DataProvider;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator as ApiPlatformPaginator;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\Pagination;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\PersonResource;
use App\Repository\PersonRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PersonResourceCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    protected PersonRepository $repository;
    protected Pagination $pagination;

    public function __construct(PersonRepository $repository, Pagination $pagination)
    {
        $this->repository = $repository;
        $this->pagination = $pagination;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        [$page, $offset, $limit] = $this->pagination->getPagination($resourceClass, $operationName, $context);
        $query = $this->repository->createQueryBuilder('p')
            ->select('p, co, c')
            ->leftJoin('p.clientObjects', 'co')
            ->leftJoin('p.clients', 'c')
            ->getQuery()
            ->setFirstResult($offset)
            ->setMaxResults($page * $limit);
        return new ApiPlatformPaginator(new Paginator($query, true));

    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return PersonResource::class === $resourceClass;
    }
}