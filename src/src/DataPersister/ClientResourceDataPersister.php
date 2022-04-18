<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\ApiResource\ClientResource;
use App\DataMapper\ClientResourceDataMapper;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class ClientResourceDataPersister implements ContextAwareDataPersisterInterface
{
    protected ClientRepository $repository;
    protected ObjectManager $entityManager;

    public function __construct(ClientRepository $repository, ManagerRegistry $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager->getManager();
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof ClientResource;
    }

    /**
     * @inheritDoc
     * @param ClientResource $data
     */
    public function persist($data, array $context = []): ClientResource
    {
        if (isset($context['collection_operation_name']) && $context['collection_operation_name'] === strtolower(Request::METHOD_POST)) {
            $entity = new Client();
        } else {
            $entity = $this->repository->find($data->id);
        }
        (new ClientResourceDataMapper())->mapToOrmEntity($entity, $data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return (new ClientResourceDataMapper())->mapToApiResource(ClientResource::class, $entity);
    }

    /**
     * @param ClientResource $data
     */
    public function remove($data, array $context = []): void
    {
        $entity = $this->repository->find($data->id);
        if (!$entity instanceof Client) {
            return;
        }
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}