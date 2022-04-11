<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\ApiResource\ConsultationResource;
use App\ApiResource\SpecialityResource;
use App\DataTransformer\SpecialityResourceTransformer;
use App\Entity\Consultation;
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
        $speciality = $this->repository->find($id);
        if (!$speciality instanceof Speciality) {
            return null;
        }
            $return = new SpecialityResource();
            $return->id = $speciality->getId();
            $return->title = $speciality->getTitle();
            $return->slug = $speciality->getSlug();
            $return->description = $speciality->getDescription();
            $return->position = $speciality->getPosition();
            $return->consultations = array_map(static function (Consultation $consultation) {
                $resource = new ConsultationResource();
                $resource->id = $consultation->getId();
                return $resource;
            } , $speciality->getConsultations()->toArray());
            return $return;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return SpecialityResource::class === $resourceClass;
    }
}