<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(shortName: 'Speciality')]
class SpecialityResource
{
    /**
     * @param string|null $id
     * @param string|null $title
     * @param string|null $slug
     * @param string|null $description
     * @param int|null $position
     */
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