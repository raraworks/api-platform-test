<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(collectionOperations: ['get'], itemOperations: ['get'], shortName: 'Specialist', normalizationContext: ['groups' => ['specialist:read']])]
class SpecialistResource
{
    #[ApiProperty(identifier: true)]
    #[Groups(['specialist:read'])]
    public string|null $id = null;

    #[Groups(['specialist:read'])]
    public string|null $name = null;

    #[Groups(['specialist:read'])]
    public string|null $subtitle = null;

    #[Groups(['specialist:read'])]
    public string|null $image = null;

    /**
     * @var ConsultationResource[]|null
     */
    #[Groups(['specialist:read'])]
    public array|null $consultations = null;
}