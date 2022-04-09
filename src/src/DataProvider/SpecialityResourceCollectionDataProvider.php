<?php

namespace App\DataProvider;

use App\ApiResource\SpecialityResource;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Speciality;
use App\Repository\SpecialityRepository;

class SpecialityResourceCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private SpecialityRepository $repository;

    public function __construct(SpecialityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getCollection(string $resourceClass, string $operationName = null): iterable
    {
        $specialities = $this->repository->getAllActiveWithConsultations();
        return array_map(static function (Speciality $speciality) {
            return new SpecialityResource(
                id: $speciality->getId(),
                title: $speciality->getTitle(),
                slug: $speciality->getSlug(),
                description: $speciality->getDescription(),
                position: $speciality->getPosition(),
            );
        }, $specialities);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return SpecialityResource::class === $resourceClass;
    }

}