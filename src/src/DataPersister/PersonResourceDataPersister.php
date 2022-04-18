<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\ApiResource\PersonResource;
use App\DataMapper\PersonResourceDataMapper;
use App\Entity\Person;
use App\Repository\PersonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class PersonResourceDataPersister implements ContextAwareDataPersisterInterface
{
    protected PersonRepository $repository;
    protected ObjectManager $entityManager;

    public function __construct(PersonRepository $repository, ManagerRegistry $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager->getManager();
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof PersonResource;
    }

    /**
     * @inheritDoc
     */
    public function persist($data, array $context = [])
    {
        if (isset($context['collection_operation_name']) && $context['collection_operation_name'] === strtolower(Request::METHOD_POST)) {
            $entity = new Person();
            (new PersonResourceDataMapper())->mapToOrmEntity($entity, $data);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            return (new PersonResourceDataMapper())->mapToApiResource(PersonResource::class, $entity);
        } else {
            // update existing record
            $ok = $data;
        }
        // TODO: Implement persist() method.
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