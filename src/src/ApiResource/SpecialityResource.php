<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(collectionOperations: ['get'], itemOperations: ['get'], shortName: 'Speciality', normalizationContext: ['groups' => ['speciality:read']])]
class SpecialityResource
{
    #[ApiProperty(identifier: true)]
    #[Groups(['speciality:read'])]
    public string|null $id = null;

    #[Groups(['speciality:read'])]
    public string|null $title = null;

    #[Groups(['speciality:read'])]
    public string|null $slug = null;

    #[Groups(['speciality:read'])]
    public string|null $description = null;

    #[Groups(['speciality:read'])]
    public int|null $position = null;

    /**
     * @var ConsultationResource[]|null
     */
    #[Groups(['speciality:read'])]
    #[ORM\OneToMany(mappedBy: "speciality", targetEntity: ConsultationResource::class)]
    public array|null $consultations = [];
}