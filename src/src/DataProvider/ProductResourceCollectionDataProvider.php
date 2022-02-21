<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\ProductResource;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class ProductResourceCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private ObjectRepository $repository;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->repository = $doctrine->getRepository(Product::class);
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, string $operationName = null): iterable
    {
        $products = $this->repository->findAll();
        return array_map(static function (Product $product) {
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
        }, $products);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return ProductResource::class === $resourceClass;
    }

}