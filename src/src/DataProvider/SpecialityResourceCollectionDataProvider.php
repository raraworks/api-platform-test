<?php

namespace App\DataProvider;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\PaginationExtension;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGenerator;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\SpecialityResource;
use App\Repository\SpecialityRepository;

class SpecialityResourceCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private SpecialityRepository $repository;

    private PaginationExtension $pagination;

    public function __construct(SpecialityRepository $repository, PaginationExtension $pagination)
    {
        $this->pagination = $pagination;
        $this->repository = $repository;
    }

    public function getCollection(string $resourceClass, string $operationName = null): iterable
    {
            $this->pagination->applyToCollection($this->repository->getAllActiveWithConsultations(), new QueryNameGenerator(), $resourceClass, $operationName);
            if ($this->pagination->supportsResult($resourceClass, $operationName)) {
                return $this->pagination->getResult($this->repository->getAllActiveWithConsultations(), $resourceClass, $operationName);
            }
        return $this->repository->getAllActiveWithConsultations()->getQuery()->getResult();
//        return array_map(static function (Speciality $speciality) {
//            return new SpecialityResource(
//                id: $speciality->getId(),
//                title: $speciality->getTitle(),
//                slug: $speciality->getSlug(),
//                description: $speciality->getDescription(),
//                position: $speciality->getPosition(),
//            );
//        }, $specialities);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return SpecialityResource::class === $resourceClass;
    }

}