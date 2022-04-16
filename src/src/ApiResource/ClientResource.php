<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeImmutable;

#[ApiResource(shortName: 'client')]
class ClientResource
{
    #[ApiProperty(identifier: true)]
    public int|null $id = null;
    public string|null $title = null;
    public string|null $regNo = null;
    public string|null $address = null;
    public string|null $billingAddress = null;
    public string|null $notes = null;
    public PersonResource|null $person = null;
    public DateTimeImmutable|null $createdAt = null;
    public DateTimeImmutable|null $updatedAt = null;
}