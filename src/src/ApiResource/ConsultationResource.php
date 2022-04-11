<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeImmutable;

#[ApiResource(collectionOperations: ['get'], itemOperations: ['get'], shortName: 'consultation')]
class ConsultationResource
{
    #[ApiProperty(identifier: true)]
    public string|null $id = null;

    public SpecialityResource|null $speciality = null;

    public SpecialistResource|null $specialist = null;

    public DateTimeImmutable|null $startAt = null;

    public DateTimeImmutable|null $endAt = null;
}