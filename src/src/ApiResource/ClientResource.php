<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeImmutable;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(shortName: 'client')]
class ClientResource
{
    #[Groups(['person:read']), ApiProperty(identifier: true)]
    public int|null $id = null;
    #[Groups(['person:read'])]
    public string|null $title = null;
    #[Groups(['person:read'])]
    public string|null $regNo = null;
    #[Groups(['person:read'])]
    public string|null $address = null;
    #[Groups(['person:read'])]
    public string|null $billingAddress = null;
    #[Groups(['person:read'])]
    public string|null $notes = null;
    public PersonResource|null $person = null;
    #[Groups(['person:read'])]
    public DateTimeImmutable|null $createdAt = null;
    #[Groups(['person:read'])]
    public DateTimeImmutable|null $updatedAt = null;
}