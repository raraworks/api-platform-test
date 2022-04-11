<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(collectionOperations: ['get'], itemOperations: ['get'], shortName: 'specialist')]
class SpecialistResource
{
    #[ApiProperty(identifier: true)]
    public string|null $id = null;

    public string|null $name = null;

    public string|null $subtitle = null;

    public string|null $image = null;

    /**
     * @var ConsultationResource[]|null
     */
    public array|null $consultations = null;
}