<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeImmutable;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(collectionOperations: ['get'], itemOperations: ['get'], shortName: 'Consultation', normalizationContext: ['groups' => ['consultation:read']])]
class ConsultationResource
{
    #[ApiProperty(identifier: true)]
    #[Groups(['consultation:read'])]
    public string|null $id = null;

    #[Groups(['consultation:read'])]
    public SpecialityResource|null $speciality = null;

    #[Groups(['consultation:read'])]
    public SpecialistResource|null $specialist = null;

    #[Groups(['consultation:read'])]
    public DateTimeImmutable|null $startAt = null;

    #[Groups(['consultation:read'])]
    public DateTimeImmutable|null $endAt = null;
}