<?php

namespace App\DataProvider;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGenerator;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\SpecialityResource;

class SpecialityResourceCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private CollectionDataProviderInterface $collectionDataProvider;

    public function __construct(CollectionDataProviderInterface $collectionDataProvider)
    {
        $this->collectionDataProvider = $collectionDataProvider;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $this->collectionDataProvider->getCollection($resourceClass, $operationName, $context);
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