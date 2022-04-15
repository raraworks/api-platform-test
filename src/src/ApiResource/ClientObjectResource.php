<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeImmutable;

#[ApiResource(shortName: 'client-object')]
class ClientObjectResource
{
    #[ApiProperty(identifier: true)]
    public int|null $id = null;
    public string|null $title = null;
    public string|null $notes = null;
    public string|null $region = null;
    public string|null $address = null;
    public string|null $contractNo = null;
    public float|null $hourlyRate = null;
    public DateTimeImmutable|null $createdAt = null;
    public DateTimeImmutable|null $updatedAt = null;
}