<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;

#[ApiResource(shortName: 'Service')]
class ServiceResource
{
    /**
     * @param string|null $id
     * @param string|null $title
     * @param string|null $slug
     * @param string|null $description
     * @param int|null $position
     * @param DateTimeInterface|null $createdAt
     * @param DateTimeInterface|null $updatedAt
     */
    public function __construct(
        public string|null            $id = null,
        public string|null            $title = null,
        public string|null            $slug = null,
        public string|null            $description = null,
        public int|null               $position = null,
        public DateTimeInterface|null $createdAt = null,
        public DateTimeInterface|null $updatedAt = null,
    )
    {
    }
}