<?php

namespace App\DataProvider;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\PaginationExtension;
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

    public function __construct(PersonRepository $repository, Pagination $pagination, PaginationExtension $paginationExtension)
    {
        $this->repository = $repository;
        $this->pagination = $pagination;
        $this->paginationExtension = $paginationExtension;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
//        $queryNameGenerator = new QueryNameGenerator();
        [$page, $offset, $limit] = $this->pagination->getPagination($resourceClass, $operationName);
        //find entities
        $query = $this->repository->createQueryBuilder('p')
            ->select('p, co, c')
            ->leftJoin('p.clientObjects', 'co')
            ->leftJoin('p.clients', 'c')
            ->getQuery()
            ->setFirstResult($offset)
            ->setMaxResults($page * $limit);
        return new \ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator(new Paginator($query, true));
//        $this->paginationExtension->applyToCollection($query, $queryNameGenerator, $resourceClass, $operationName, $context);
//        if ($this->paginationExtension->supportsResult($resourceClass, $operationName, $context)) {
//            return $this->paginationExtension->getResult($query, $resourceClass, $operationName, $context);
//        }
        //        $paginator = new Paginator($query, true);
//
//        $decoratedPaginator = new \ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator($paginator);
//        //normalize collection items to resource with the help of mapper
////        $dataMapper = new PersonResourceDataMapper();
////        foreach ($paginator as &$entity) {
////            $entity = $dataMapper->mapToApiResource(PersonResource::class, $entity);
////        }
//        //use default encoder logic for the paginator instance
//        return new \ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator($paginator);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return PersonResource::class === $resourceClass;
    }
}