<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\ProductResource;
use App\Entity\Speciality;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class ProductResourceItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
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

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ProductResource|null
    {
        $product = $this->repository->find($id);
        if (!$product instanceof Speciality) {
            return null;
        }
        return new ProductResource(
            id: $product->getId(),
            sku: $product->getSku(),
            title: $product->getTitle(),
            slug: $product->getSlug(),
            description: $product->getDescription(),
            imageFile: $product->getImageFile(),
            createdAt: $product->getCreatedAt(),
            updatedAt: $product->getUpdatedAt()
        );
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return ProductResource::class === $resourceClass;
    }
}