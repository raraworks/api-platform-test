<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(shortName: 'Speciality')]
class SpecialityResource
{
    public function __construct(
        public string|null            $id = null,
        public string|null            $title = null,
        public string|null            $slug = null,
        public string|null            $description = null,
        public int|null               $position = null,
    )
    {
    }
}