<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeImmutable;

#[ApiResource(shortName: 'person')]
class PersonResource
{
    #[ApiProperty(identifier: true)]
    public int|null $id = null;
    public string|null $fullName = null;
    public string|null $email = null;
    public string|null $phoneNo = null;
    /**
     * @var ClientObjectResource[]|null
     */
    #[ApiProperty(readableLink: true)]
    public array|null $clientObjects = null;
    public DateTimeImmutable|null $createdAt = null;
    public DateTimeImmutable|null $updatedAt = null;
}