<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(collectionOperations: ['get'], itemOperations: ['get'], shortName: 'speciality')]
class SpecialityResource
{
    #[ApiProperty(identifier: true)]
    public string|null $id = null;

    public string|null $title = null;

    public string|null $slug = null;

    public string|null $description = null;

    public int|null $position = null;

    /**
     * @var iterable|null
     */
    public iterable|null $consultations = null;
}