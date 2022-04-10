<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\ApiResource\SpecialityResource;
use App\Entity\Speciality;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SpecialityResourceDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof SpecialityResource;
    }

    /**
     * @param \App\ApiResource\SpecialityResource $data
     */
    public function persist($data, array $context = [])
    {
        $speciality = new Speciality();
        $speciality->setTitle($data->title)
            ->setSlug($data->slug)
            ->setDescription($data->description)
            ->setIsActive(true)
            ->setPosition(1)
            ->setCreatedAt(new DateTimeImmutable())
            ->setUpdatedAt(new DateTimeImmutable());
        $this->entityManager->persist($speciality);
        $this->entityManager->flush();
        return new Response('Saved new speciality');
    }

    /**
     * @param \App\ApiResource\SpecialityResource $data
     */
    public function remove($data, array $context = []): void
    {
        $entity = $this->entityManager->find(Speciality::class, $data->id);
        if (!$entity instanceof Speciality) {
            throw new NotFoundHttpException(
                'No speciality found for id '. $data->id
            );
        }
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}