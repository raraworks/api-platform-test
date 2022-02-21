<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\ApiResource\ProductResource;
use Doctrine\ORM\EntityManagerInterface;

final class ProductDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof ProductResource;
    }

    /**
     * @inheritDoc
     */
    public function persist($data, array $context = [])
    {
        //call doctrine entity manager
    }

    /**
     * @inheritDoc
     */
    public function remove($data, array $context = [])
    {
        // TODO: Implement remove() method.
    }
}