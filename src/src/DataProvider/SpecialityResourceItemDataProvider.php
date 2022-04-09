<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\SpecialityResource;
use App\Entity\Speciality;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Uid\Uuid;

class SpecialityResourceItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var ObjectRepository
     */
    private ObjectRepository $repository;

    /**
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->repository = $doctrine->getRepository(Speciality::class);
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): SpecialityResource|null
    {
        if (!Uuid::isValid($id)) {
            throw new NotFoundHttpException();
        }
        $product = $this->repository->find($id);
        if (!$product instanceof Speciality) {
            return null;
        }
        return new SpecialityResource(
            id: $product->getId(),
            title: $product->getTitle(),
            slug: $product->getSlug(),
            description: $product->getDescription(),
        );
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return SpecialityResource::class === $resourceClass;
    }
}