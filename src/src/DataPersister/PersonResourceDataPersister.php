<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\ApiResource\PersonResource;
use App\DataMapper\PersonResourceDataMapper;
use App\Entity\Person;
use App\Repository\ClientRepository;
use App\Repository\PersonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class PersonResourceDataPersister implements ContextAwareDataPersisterInterface
{
    protected PersonRepository $repository;
    protected ObjectManager $entityManager;
    protected ClientRepository $clientRepository;

    public function __construct(PersonRepository $repository, ManagerRegistry $entityManager, ClientRepository $clientRepository)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager->getManager();
        $this->clientRepository = $clientRepository;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof PersonResource;
    }

    /**
     * @inheritDoc
     * @param PersonResource $data
     */
    public function persist($data, array $context = []): PersonResource
    {
        if (isset($context['collection_operation_name']) && $context['collection_operation_name'] === strtolower(Request::METHOD_POST)) {
            $entity = new Person();
        } else {
            $entity = $this->repository->find($data->id);
        }
        (new PersonResourceDataMapper($this->clientRepository))->mapToOrmEntity($entity, $data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return (new PersonResourceDataMapper($this->clientRepository))->mapToApiResource(PersonResource::class, $entity);
    }

    /**
     * @param PersonResource $data
     */
    public function remove($data, array $context = []): void
    {
        $entity = $this->repository->find($data->id);
        if (!$entity instanceof Person) {
            return;
        }
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}